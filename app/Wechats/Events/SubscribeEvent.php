<?php
namespace App\Wechats\Events;

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
