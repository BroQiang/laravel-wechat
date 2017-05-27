<?php
namespace App\Wechats\events;

class ScanEvent
{
    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function scanHandler()
    {
    	
    }
}
