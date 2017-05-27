<?php
namespace App\Wechats;

use EasyWeChat\Message\Text;

class Event
{
	public function eventHandler($message)
	{
	    return new Text(['content' => '你好，测试消息']);
	}
}
