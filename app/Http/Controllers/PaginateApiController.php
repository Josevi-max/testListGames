<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PaginateApiController extends Controller
{
    public function paginate(Request $request) {

        $sizePage = isset( $request["page_size"])? $request["page_size"] : 15;
        $specialSearch = isset( $request["filters"])? $request["filters"] : '';
        $total = (int)$request['total_pages'];
        $page = (int)$request['page'];
        $actualPage = (int)$request['actualPage'];
        if ($page > $total | $page <= 1) {
            $page = 1;
            $actualPage = 1;
        }
        if ($request['next']!='') {
            $urlApi = $request['next'].="&page=${page}";
            $actualPage+=1;
        } else {
           $urlApi = $request['previous'].="&page=${page}";
           $actualPage-=1;
        }

        $api= Http::get($urlApi);
        $search=$api->json();
        $actualPage = $page;
        return redirect()->route("home.index")->with("search", $search)->with("sizePage", $sizePage)->with("specialSearch",$specialSearch)->with("actualPage",$actualPage);

    }
}
