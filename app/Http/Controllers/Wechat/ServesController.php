<?php

namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;

class ServesController extends Controller
{
    public function index(Application $wechat)
    {
    	Log::info($wechat);
        return $wechat->server->serve()->send();
    }
}
