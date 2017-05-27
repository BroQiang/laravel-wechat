<?php
namespace App\Repositories;

use App\Models\WxMenu;
use App\Models\WxSubMenu;
use App\Repositories\CommonRepository;
use InvalidArgumentException;

class WxMenuRepository
{

    use CommonRepository;

    protected $maxMenu    = 3;
    protected $maxSubMenu = 5;
    protected $actions    = [
        'click' => 'key',
        'view'  => 'url',
    ];

    protected $unsetFields = ['id', 'created_at', 'updated_at', 'action', 'wx_menu_id'];

    public function store($data)
    {
        return WxMenu::create($data);
    }

    public function getMenuById($id)
    {
        return WxMenu::find($id);
    }

    public function getSubMenuById($id)
    {
        return WxSubMenu::find($id);
    }

    public function getExistsMenuAndSubMenu($id, $subId = null, $isAll = false)
    {

        if (empty($wxMenu = $this->getMenuById($id))) {
            throw new InvalidArgumentException("无效的菜单");
        }

        if ($isAll) {
            if (empty($wxSubMenu = $this->getSubMenuById($subId))) {
                throw new InvalidArgumentException("无效的子菜单");
            }
            return ['wxMenu' => $wxMenu, 'wxSubMenu' => $wxSubMenu];
        }

        return ['wxMenu' => $wxMenu];
    }

    public function getAllMenuById($id)
    {
        if ($id) {
            if ($wxMenu = WxMenu::with('wxSubMenu')->find($id)) {
                return $wxMenu;
            }
        }

        return WxMenu::with('wxSubMenu')->first();

    }

    public function allMenu()
    {
        return WxMenu::all();
    }

    public function storeSubMenu($data, $id)
    {
        $data['wx_menu_id'] = $id;

        WxSubMenu::create($data);

        return $this->getAllMenuById($id);

    }

    public function validateMenuNumber($id = null)
    {
        if ($id) {
            return WxSubMenu::where('wx_menu_id', $id)->count() < $this->maxSubMenu;
        }

        return WxMenu::count() < $this->maxMenu;
    }

    public function saveMenu($data, $id)
    {
        $wxMenu = $this->arrayToObject($this->getMenuById($id), $data);

        $wxMenu->save();

        return $wxMenu->load('wxSubMenu');
    }

    public function saveSubMenu($data, $id, $subId)
    {
        $wxSubMenu = $this->arrayToObject($this->getSubMenuById($subId), $data);

        $wxSubMenu->save();
        return $this->getAllMenuById($id);
    }

    public function deleteMenu($id)
    {
        return WxMenu::destroy($id);
    }

    public function deleteSubMenu($id, $subId)
    {
        WxSubMenu::destroy($subId);

        return $this->getAllMenuById($id);
    }

    public function hasSub($id)
    {
        $wxMenu = $this->getMenuById($id);
        return $wxMenu->wxSubMenu()->first();
    }

    public function getPublishMenus()
    {
        return $this->formatPublishMenus(WxMenu::with('wxSubMenu')->get()->toArray());
    }

    protected function formatPublishMenus($wxMenus)
    {
        return array_map([$this, 'menuToArray'], $wxMenus);
    }

    protected function menuToArray($wxMenu)
    {
        $wxMenu[$this->actions[$wxMenu['type']]] = $wxMenu['action'];

        $wxMenu = $this->unsetMenuField($wxMenu);

        if (isset($wxMenu['wx_sub_menu']) && !empty($wxMenu['wx_sub_menu'])) {
            $wxMenu['sub_button'] = $this->formatPublishMenus($wxMenu['wx_sub_menu']);
        }

        unset($wxMenu['wx_sub_menu']);

        return $wxMenu;
    }

    protected function unsetMenuField($data)
    {
        foreach ($this->unsetFields as $field) {
            if (isset($data[$field])) {
                unset($data[$field]);
            }
        }
        return $data;
    }
}
