<?php
namespace App\Wechats;

use EasyWeChat\Foundation\Application;

class Menus
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function all()
    {
    	return $this->app->menu->all();
    }

}
