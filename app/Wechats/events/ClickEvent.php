<?php
namespace App\Wechats\events;

use EasyWeChat\Message\Text;

class ClickEvent
{
    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function clickHandler()
    {
    	return new Text(['content' => '你点了我的菜单']);
    }
}
