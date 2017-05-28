<?php
namespace App\Wechats\Events;

use App\Wechats\Activities\Posters;

class ClickEvent
{
    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function clickHandler()
    {
        \Illuminate\Support\Facades\Log::info('----------- ClickEvent -----------');
        // 暂时只有海报活动一个点击事件，时间又紧，就先写死了，等有空再处理
        return (new Posters($this->message))->posterHandler();

    }
}
