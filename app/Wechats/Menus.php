<?php
namespace App\Wechats;

use EasyWeChat\Foundation\Application;

class Menus
{
    private $menu;

    public function __construct(Application $app)
    {
        $this->menu = $app->menu;
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
