<?php
namespace App\Wechats\events;

class SubscribeEvent
{
    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function subscribeHandler()
    {

    }
}
