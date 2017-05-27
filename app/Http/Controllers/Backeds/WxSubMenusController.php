<?php

namespace App\Http\Controllers\Backeds;

use App\Http\Controllers\Controller;
use App\Http\Requests\WxmenusRequest;
use App\Repositories\WxMenuRepository;
use Illuminate\Http\Request;

class WxSubMenusController extends Controller
{

    private $wxMenu;

    public function __construct(WxMenuRepository $wxMenu)
    {
        $this->wxMenu = $wxMenu;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        if (!$this->wxMenu->validateMenuNumber($id)) {
            return back()->with('error', '一个主菜单最多能创建5个子菜单');
        }

        return view('backeds.wx_menus.create')
            ->with('wxMenu', (new WxMenuRepository())->getMenuById($id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WxmenusRequest $request, $id)
    {
        $wxMenu = $this->wxMenu->storeSubMenu($request->all(), $id);

        return redirect()->action('Backeds\WxmenusController@index', compact('wxMenu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $subId)
    {
        return view('backeds.wx_menus.editSubMenu',
            $this->wxMenu->getExistsMenuAndSubMenu($id, $subId, true));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $subId)
    {
        return redirect()->action('Backeds\WxmenusController@index',
            ['wxMenu' => $this->wxMenu->saveSubMenu($request->all(), $id, $subId)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$subId)
    {
        return redirect()->action('Backeds\WxmenusController@index',
            ['wxMenu' => $this->wxMenu->deleteSubMenu($id, $subId)]);
    }
}
