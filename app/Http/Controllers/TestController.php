<?php

namespace App\Http\Controllers;

use App\Wechats\Activities\Posters;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $app = new Posters();

        dd($app->posterHandler());
    }
}
