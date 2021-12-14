<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class usersController extends Controller
{
    public function index()
    {
        $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->get('http://'.env('WOWZA_HOST_URL').':8087/v2/servers/_defaultServer_/users');
        if ($response->successful()) {
            return view("users", ['users' => $response->collect()]);
        }else {
            return view("users", ['users' => []]);
        }
    }
    public function destroy(Request $request)
    {
        $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->delete('http://'.env('WOWZA_HOST_URL').':8087/v2/servers/_defaultServer_/users/'.$request->userName);
        if ($response->successful()) {
            return redirect('/users');
    }
}
