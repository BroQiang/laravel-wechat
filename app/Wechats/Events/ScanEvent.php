<?php
namespace App\Wechats\Events;

use App\Wechats\Activities\Posters;

class ScanEvent
{
    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function scanHandler()
    {
    	\Illuminate\Support\Facades\Log::log('--------------------------------------------------- ClickEvent ----------------------------------------------');
    	return (new Posters($this->message))->posterHandler();
    }
}
