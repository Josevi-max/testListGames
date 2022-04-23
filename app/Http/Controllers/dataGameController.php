<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class dataGameController extends Controller
{
    public function dataGame($id){
        $api= Http::get("https://api.rawg.io/api/games/${id}?key=6c89b42c4215483c8ab7488dcafe2f2a");
        $data= $api->json();

        $api= Http::get("https://api.rawg.io/api/games/${id}/screenshots?key=6c89b42c4215483c8ab7488dcafe2f2a&page_size=20");
        $screenshots=$api->json();

        $api= Http::get("https://api.rawg.io/api/games/${id}/stores?key=6c89b42c4215483c8ab7488dcafe2f2a&page_size=20");
        $shop=$api->json();


        $listsUser = DB::table('list_games')->where('id_user', '=', Auth::id())->get("name");

        if (session("failUpdate")) {
            $failUpdate = session("failUpdate");
        }

        if (session("createList")) {
            $createList = session("createList");
        }

        return view("dataGame",compact("data","screenshots","listsUser","shop", isset($failUpdate) ? 'failUpdate' : null,isset($createList) ? 'createList' : null));
    }
}
