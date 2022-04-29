<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Helpers\Api;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class searchGameController extends Controller
{
    use Api;
    public function searchGame(Request $request)
    {   
        $sizePage = isset( $request["page_size"])? $request["page_size"] : 15;
        $isNull= $request['search']!=null ? "&search= ${request['search']}&page_size=${sizePage}":'';
        $specialSearch = isset( $request["filters"])? $request["filters"] : '';
        $actualPage =  isset($request["actualPage"]) ? (int) $request["actualPage"] : '' ;
        if (isset($request["next"])) {
            $urlApi = $request["next"];
            $actualPage+=1;
        } else if(isset($request["previous"])) {
            $urlApi = $request["previous"];
            $actualPage-=1;
        } else {
            $urlApi = "https://api.rawg.io/api/games?key=6c89b42c4215483c8ab7488dcafe2f2a${isNull}";
        }
        
        $api= Http::get($urlApi);
        $search=$api->json();
        return redirect()->route("home.index")->with("search", $search)->with("sizePage", $sizePage)->with("specialSearch",$specialSearch)->with("actualPage",$actualPage);
    }

    public function specialSearch(Request $request) {
        $sizePage = isset( $request["page_size"])? $request["page_size"] : 15;
        $specialSearch = $request["show"];
        $startDate = '';
        $endDate = '';
        if (isset($request["trip-start"])) {
            $startDate = $request["trip-start"];
            $endDate = $request["trip-end"];
        }
        
        return $this->search($specialSearch,$sizePage,'home.index', '' ,$startDate,$endDate);
        
    }

    public function searchList(Request $request) {
        $list = $request['actualList'];
        $search = strtolower($request['search']);
        $data = json_decode($request["games"]);
        $resultSearch = [];
        foreach ($data as $key => $value) {
            if(str_contains(strtolower($value->name), $search)) {
                array_push($resultSearch,$value);
                
            }
            $resultSearch = json_decode(json_encode($resultSearch), true);
            $paginate = $this->paginate($resultSearch,6,'list/'.$list);
        }
        return redirect()->back()->with("paginate", $paginate)->with("actualList", $list)->with("dataGamesList",$data);
    }
}

