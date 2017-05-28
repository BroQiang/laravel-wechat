<?php
namespace App\Wechats;

class Menus
{
    protected $menu;

    public function __construct()
    {
        $this->menu = app('wechat')->menu;
    }

    public function current()
    {
        return $this->menu->current();
    }

    public function publish($buttons)
    {
        return $this->menu->add($buttons);
    }

}
