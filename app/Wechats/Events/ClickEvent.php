<?php
namespace App\Wechats\Events;

use EasyWeChat\Message\Text;

class ClickEvent
{
    protected $message;

    /**
     * 定义Key对应的类，暂时先不处理了，等有空再处理
     */
    protected $keys = [
        'activity_push_poster' => 'App\\Wechats\\Activities\\Posters',
    ];

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function clickHandler()
    {
        // 暂时只有海报活动一个点击事件，时间又紧，就先写死了，等有空再处理
        $keyword = 'activity_push_poster';
        $len = strlen($keyword);

        if(strncmp($keyword,substr($this->message->EventKey, 0,$len),$len) == 0) {
            new Text(['content' => '你点击了菜单']);
        }
    }
}
