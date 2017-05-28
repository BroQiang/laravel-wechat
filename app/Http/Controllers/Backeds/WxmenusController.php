<?php

namespace App\Http\Controllers\Backeds;

use App\Http\Controllers\Controller;
use App\Http\Requests\WxmenusRequest;
use App\Http\Requests\WxMenuUpdateRequest;
use App\Repositories\WxMenuRepository;
use App\Wechats\Menus;
use EasyWeChat\Core\Exceptions\HttpException;
use Illuminate\Http\Request;

class WxmenusController extends Controller
{

    private $wxMenu;

    public function __construct(WxMenuRepository $wxMenu)
    {
        $this->wxMenu = $wxMenu;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backeds.wx_menus.index')
            ->with('wxMenus', $this->wxMenu->allMenu())
            ->with('wxMenu', $this->wxMenu->getAllMenuById(request()->input('wxMenu')));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!$this->wxMenu->validateMenuNumber()) {
            return back()->with('error', '主菜单只能最多有3个');
        }

        return view('backeds.wx_menus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WxmenusRequest $request)
    {
        $wxMenu = $this->wxMenu->store($request->all());

        return redirect()->action('Backeds\WxmenusController@index', compact('wxMenu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backeds.wx_menus.edit',
            $this->wxMenu->getExistsMenuAndSubMenu($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WxMenuUpdateRequest $request, $id)
    {
        return redirect()->action('Backeds\WxmenusController@index',
            ['wxMenu' => $this->wxMenu->saveMenu($request->all(), $id)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->wxMenu->hasSub($id)) {
            return back()->with('error', '只能删除没有子菜单的一级菜单，请先删除菜单下的子菜单');
        }

        $this->wxMenu->deleteMenu($id);

        return redirect('backed/wxmenu');
    }

    public function publish(Menus $menus)
    {
        try {
            $menus->publish($this->wxMenu->getPublishMenus());
            session()->flash('success', '菜单成功发布到微信！！');
        } catch (HttpException $e) {
            session()->flash('error', "菜单失败！！错误：{$e->getMessage()}");
        }

        return redirect('backed/wxmenu');
    }
}
