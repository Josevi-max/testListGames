<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class searchGameController extends Controller
{
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
        $actualDate = date('Y-m-d');
        switch ($specialSearch) {
            case 'Populares':
                
                $lastYear = date('Y')-1;
                $callApi= Http::get("https://api.rawg.io/api/games?key=6c89b42c4215483c8ab7488dcafe2f2a&dates=${lastYear}-01-01,${actualDate}&ordering=-added&page_size=${sizePage}");
                $search=$callApi->json();
                return redirect()->route("home.index")->with("search", $search)->with("sizePage", $sizePage)->with("specialSearch",$specialSearch);
                break;
            case 'Puntuados':
                
                $callApi= Http::get("https://api.rawg.io/api/games?key=6c89b42c4215483c8ab7488dcafe2f2a&dates=2000-01-01,${actualDate}&ordering=-rating&page_size=${sizePage}");
                $search=$callApi->json();
                return redirect()->route("home.index")->with("search", $search)->with("sizePage", $sizePage)->with("specialSearch",$specialSearch);
                break;             
            case 'Esperados':    
                $nextYear = date('Y')+1;
                $callApi= Http::get("https://api.rawg.io/api/games?key=6c89b42c4215483c8ab7488dcafe2f2a&dates=${actualDate},${nextYear}-01-01&ordering=-added&page_size=${sizePage}");
                $search=$callApi->json();
                return redirect()->route("home.index")->with("search", $search)->with("sizePage", $sizePage)->with("specialSearch",$specialSearch);
                break;
            default:
                $lastMonth = date("Y-m-d",strtotime('-1 months', strtotime($actualDate)));
                $api= Http::get("https://api.rawg.io/api/games?key=6c89b42c4215483c8ab7488dcafe2f2a&dates=${lastMonth},${actualDate}&page_size=${sizePage}");
                $search = $api->json();
                return redirect()->route("home.index")->with("search", $search)->with("sizePage", $sizePage)->with("specialSearch",$specialSearch);
                break;
        }
    }
}
