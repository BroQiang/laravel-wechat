<?php

namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
use Illuminate\Support\Facades\Log;

class ServesController extends Controller
{
    public function index(Application $wechat)
    {
    	Log::info($wechat);
        return $wechat->server->serve()->send();
    }
}
