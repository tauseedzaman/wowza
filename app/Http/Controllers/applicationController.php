<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class applicationController extends Controller
{
    public function index()
    {
        return view("applications");
    }
}
