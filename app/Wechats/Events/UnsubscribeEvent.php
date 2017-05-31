<?php
namespace App\Wechats\Events;

class UnsubscribeEvent
{
    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function unsubscribeHandler()
    {
    	\Illuminate\Support\Facades\Log::info('----------- ClickEvent -- $this->message->FromUserName -----------');
    	return null;
    }
}
