<?php
namespace App\Wechats\Events;

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
