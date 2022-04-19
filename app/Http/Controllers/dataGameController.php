<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class dataGameController extends Controller
{
    public function dataGame($id){
        $api= Http::get("https://api.rawg.io/api/games/${id}?key=6c89b42c4215483c8ab7488dcafe2f2a");
        $data= $api->json();

        $api = Http::get("https://api.rawg.io/api/games/${id}/stores?key=6c89b42c4215483c8ab7488dcafe2f2a");
        $shop = $api->json();

        $api= Http::get("https://api.rawg.io/api/games/${id}/screenshots?key=6c89b42c4215483c8ab7488dcafe2f2a&page_size=20");
        $screenshots=$api->json();

        return view("dataGame",compact("data","shop","screenshots"));
    }
}
