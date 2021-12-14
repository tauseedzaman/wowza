<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class streamsController extends Controller
{
    public function index()
    {
        return view("streams");
    }
}
