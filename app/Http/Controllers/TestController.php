<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    public function index()
    {
        return response('404', 404)
            ->header('Content-Type', 'text/plain');
    }
}
