<?php
namespace App\Wechats\Events;

class ClickEvent
{
    protected $message;

    /**
     * 定义Key对应的类
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
        $key = $this->message->EventKey;
    }
}
