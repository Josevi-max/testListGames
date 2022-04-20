<?php

namespace Helpers;

use Illuminate\Support\Facades\Http;

trait Api
{

    function search($specialSearch = '' , $sizePage, $route = '', $view = '')
    {
        $actualDate = date('Y-m-d');
        switch ($specialSearch) {
            
            case 'Puntuados':
                $callApi= Http::get("https://api.rawg.io/api/games?key=6c89b42c4215483c8ab7488dcafe2f2a&dates=2000-01-01,${actualDate}&ordering=-rating&page_size=${sizePage}");
                $search=$callApi->json();
                if ($route) {
                    return redirect()->route($route)->with("search", $search)->with("sizePage", $sizePage)->with("specialSearch",$specialSearch);
                } else if($view){
                    $searchDataView = $search;
                    return view($view, compact("searchDataView","sizePage"));
                } else {
                    return $search;
                }
                break;             
            case 'Esperados':    
                $nextYear = date('Y')+1;
                $callApi= Http::get("https://api.rawg.io/api/games?key=6c89b42c4215483c8ab7488dcafe2f2a&dates=${actualDate},${nextYear}-01-01&ordering=-added&page_size=${sizePage}");
                $search=$callApi->json();
                if ($route) {
                    return redirect()->route($route)->with("search", $search)->with("sizePage", $sizePage)->with("specialSearch",$specialSearch);
                } else if($view){
                    $searchDataView = $search;
                    return view($view, compact("searchDataView","sizePage"));
                } else {
                    return $search;
                }
                break;
            case 'Lanzamientos':
                $lastMonth = date("Y-m-d",strtotime('-1 months', strtotime($actualDate)));
                $api= Http::get("https://api.rawg.io/api/games?key=6c89b42c4215483c8ab7488dcafe2f2a&dates=${lastMonth},${actualDate}&page_size=${sizePage}");
                $search = $api->json();
                if ($route) {
                    return redirect()->route($route)->with("search", $search)->with("sizePage", $sizePage)->with("specialSearch",$specialSearch);
                } else if ($view){
                    $searchDataView = $search;
                    return view($view, compact("searchDataView","sizePage"));
                } else {
                    return $search;
                }
                break;
            default: 
                $lastYear = date('Y')-1;
                $callApi= Http::get("https://api.rawg.io/api/games?key=6c89b42c4215483c8ab7488dcafe2f2a&dates=${lastYear}-01-01,${actualDate}&ordering=-added&page_size=${sizePage}");
                $search=$callApi->json();
                if ($route) {
                    return redirect()->route($route)->with("search", $search)->with("sizePage", $sizePage)->with("specialSearch",$specialSearch);
                } else if ($view){
                    $searchDataView = $search;
                    return view($view, compact("searchDataView","sizePage"));
                } else {
                    return $search;
                }
                break;
        
        }
    }
}