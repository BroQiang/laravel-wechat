<?php

namespace App\Http\Controllers\Wechats;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        dd(request()->all());
    }

    public function test()
    {
        dd(request()->all());
    }
}
