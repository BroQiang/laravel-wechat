<?php

namespace App\Http\Controllers\Wechats;

use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
use Illuminate\Support\Facades\Log;

class ServesController extends Controller
{
	private $wechat;

	public function __construct(Application $wechat)
	{
		$this->wechat = $wechat;
	}

    public function index()
    {
        return $this->wechat->server->serve()->send();
    }
}
