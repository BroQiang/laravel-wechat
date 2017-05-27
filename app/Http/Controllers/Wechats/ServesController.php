<?php

namespace App\Http\Controllers\Wechats;

use App\Http\Controllers\Controller;
use App\Wechats\Messages;
use EasyWeChat\Foundation\Application;
use Illuminate\Support\Facades\Log;

class ServesController extends Controller
{
	private $server;

	public function __construct(Application $app)
	{
		$this->server = $app->server;
	}

    public function index()
    {
    	$this->server->setMessageHandler([Messages::class,'messageHandler']);
        return $this->server->serve()->send();
    }
}
