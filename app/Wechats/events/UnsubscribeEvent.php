<?php
namespace App\Wechats\events;

class UnsubscribeEvent
{
    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function unsubscribeHandler()
    {
    	
    }
}
