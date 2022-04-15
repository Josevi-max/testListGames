<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class dataGameController extends Controller
{
    public function dataGame($id)
    {   
        $api= Http::get("https://api.rawg.io/api/games/${id}?key=6c89b42c4215483c8ab7488dcafe2f2a");
        $data=$api->json();
        return view("dataGame",compact("data"));
    }
}
