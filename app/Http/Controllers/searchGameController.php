<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class searchGameController extends Controller
{
    public function searchGame(Request $request)
    {   
        $isNull= $request['search']!=null ? "&search=${request['search']}&page_size=5":'';
        $api= Http::get("https://api.rawg.io/api/games?key=6c89b42c4215483c8ab7488dcafe2f2a${isNull}");
        $search=$api->json();
        return redirect()->route("list.create")->with("search", $search);
    }
}
