<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Helpers\Api;

class searchGameController extends Controller
{
    use Api;
    public function searchGame(Request $request)
    {   
        $sizePage = isset( $request["page_size"])? $request["page_size"] : 15;
        $isNull= $request['search']!=null ? "&search= ${request['search']}&page_size=${sizePage}":'';
        $specialSearch = isset( $request["filters"])? $request["filters"] : '';
        if (isset($request["next"])) {
            $urlApi = $request["next"];
        }else {
            $urlApi = "https://api.rawg.io/api/games?key=6c89b42c4215483c8ab7488dcafe2f2a${isNull}";
        }
        
        $api= Http::get($urlApi);
        $search=$api->json();
        return redirect()->route("home.index")->with("search", $search)->with("sizePage", $sizePage)->with("specialSearch",$specialSearch);
    }

    public function specialSearch(Request $request) {
        $sizePage = isset( $request["page_size"])? $request["page_size"] : 15;
        $specialSearch = $request["show"];
        return $this->search($specialSearch,$sizePage,'home.index');
        
    }
}
