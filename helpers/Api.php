<?php

namespace Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

trait Api
{

    function search($specialSearch = '' , $sizePage, $route = '', $view = '',$startDate = '', $endDate = '', $page = 1)
    {
        $actualDate = date('Y-m-d');
        switch ($specialSearch) {
            
            case 'Puntuados':
                if ($startDate) {
                    $callApi= Http::get("https://api.rawg.io/api/games?key=6c89b42c4215483c8ab7488dcafe2f2a&dates=${startDate},${endDate}&ordering=-rating&page_size=${sizePage}&page=${page}");
                    $search=$callApi->json();
                } else {
                    $callApi= Http::get("https://api.rawg.io/api/games?key=6c89b42c4215483c8ab7488dcafe2f2a&dates=2000-01-01,${actualDate}&ordering=-rating&page_size=${sizePage}&page=${page}");
                    $search=$callApi->json();
                }
                
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

                if ($startDate) {
                    $callApi= Http::get("https://api.rawg.io/api/games?key=6c89b42c4215483c8ab7488dcafe2f2a&dates=${startDate},${endDate}&ordering=-added&page_size=${sizePage}&page=${page}");
                    $search=$callApi->json();
                } else {
                    $nextYear = date('Y')+1;
                    $callApi= Http::get("https://api.rawg.io/api/games?key=6c89b42c4215483c8ab7488dcafe2f2a&dates=${actualDate},${nextYear}-01-01&ordering=-added&page_size=${sizePage}&page=${page}");
                    $search=$callApi->json();
                }
                
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

                if ($startDate) {
                    $callApi= Http::get("https://api.rawg.io/api/games?key=6c89b42c4215483c8ab7488dcafe2f2a&dates=${startDate},${endDate}&page_size=${sizePage}&page=${page}");
                    $search=$callApi->json();
                } else {
                    $lastMonth = date("Y-m-d",strtotime('-1 months', strtotime($actualDate)));
                    $api= Http::get("https://api.rawg.io/api/games?key=6c89b42c4215483c8ab7488dcafe2f2a&dates=${lastMonth},${actualDate}&page_size=${sizePage}&page=${page}");
                    $search = $api->json();
                }
                
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

                if ($startDate) {
                    $callApi= Http::get("https://api.rawg.io/api/games?key=6c89b42c4215483c8ab7488dcafe2f2a&dates=${startDate},${endDate}&ordering=-added&page_size=${sizePage}&page=${page}");
                    $search=$callApi->json();
                } else {
                    $lastYear = date('Y')-1;
                    $callApi= Http::get("https://api.rawg.io/api/games?key=6c89b42c4215483c8ab7488dcafe2f2a&dates=${lastYear}-01-01,${actualDate}&ordering=-added&page_size=${sizePage}&page=${page}");
                    $search=$callApi->json();
                }


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


    public function paginate($items, $perPage = 5, $path)
    {

        $collection = collect($items);
        $page = LengthAwarePaginator::resolveCurrentPage();

        
        $paginate = new LengthAwarePaginator(
            $collection->forPage($page, $perPage),
            $collection->count(),
            $perPage,
            $page,
            ['path' => url($path)]
        );

        return $paginate;
    }
}