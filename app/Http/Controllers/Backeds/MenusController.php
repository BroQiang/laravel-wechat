<?php

namespace App\Http\Controllers\Backeds;

use App\Http\Controllers\Controller;
use App\Wechats\Menus;

class MenusController extends Controller
{
    public function all(Menus $menu)
    {
        dd($menu->all());
    }
}
