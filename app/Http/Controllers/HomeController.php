<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;
use Helpers\Api;
class HomeController extends Controller
{
    use Api;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = DB::table('list_games')->where("id_user","=",Auth::id())->get("name");
        if (session("dataGamesList")) {
            $gamesList = session("dataGamesList");
            $actualListGames = session("actualList");
        }

        if (session("dataCarrusel")) {
            $carrusel = session("dataCarrusel");
        }
        
        if (session("isEmpty")) {
            $emptyList = session("isEmpty");
        }

        if (session("createList")) {
            $createList = session("createList");
        }

        if (session("specialSearch")) {
            $specialSearch = session("specialSearch");
        } else if(isset($filters)){
            $specialSearch = $filters;
        }else {
            $specialSearch = "Populares";
        }

        if (session("actualPage")) {
            $actualPage = session("actualPage");
        } else {
            $actualPage = 1;
        }

        if (session("search")) {
            $search = session("search");
            $sizePage = session("sizePage");
            $lastSearch = session("lastSearch");
        } else {
            $sizePage = 15;
            $lastSearch = '';
            $search =$this->search("Populares",$sizePage);
        }

        if (session("failUpdate")) {
            $failUpdate = session("failUpdate");
        }

        $listsUser = DB::table('list_games')->where('id_user', '=', Auth::id())->get("name");
        return view("components/home",compact(
        "list", "listsUser", "actualPage", isset($gamesList)?"gamesList":null, isset($actualListGames)?"actualListGames":null, isset($emptyList)?"emptyList":null, isset($createList)?"createList":null,
        isset($search)?"search":null,
        isset($failUpdate)?"failUpdate":null, isset($sizePage)?"sizePage":null, isset($lastSearch)?"lastSearch":null, isset($specialSearch)?"specialSearch":null, isset($carrusel)?"carrusel":null) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (session("createList")) {
            $createList = session("createList");
        }

        if (session("search")) {
            $search = session("search");
        }

        if (session("failUpdate")) {
            $failUpdate = session("failUpdate");
        }

        $listsUser = DB::table('list_games')->where('id_user', '=', Auth::id())->get("name");

        return view("createList", compact(
            "listsUser",
             isset($createList)?"createList":null,
             isset($search)?"search":null,
             isset($failUpdate)?"failUpdate":null
             )) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $createList = "false";
        if ($request['name_list']!='') {
            $nameList = $request['name_list'];
            if (!DB::table('list_games')->where('name', '=', $nameList )->where('id_user', '=', Auth::id())->exists()) {
                if (!DB::table('list_games')->insert([
                    "name" => $request['name_list'],
                    "id_user" => Auth::id()])) {
                        $createList = "true";
                } 
            }else {
                $createList = "true";
            }
        } else {
            $createList = "true";
        }
        return redirect()->back()->with("createList", $createList);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id_games = DB::table('list_games')->where("name","=",$request["list"] )->where("id_user", "=", Auth::id())->get("id_games");
        $failUpdate = "false";
        $sizePage = $request["sizePage"];
        $actualPage = $request["actualPage"];
        if ($id_games[0]->id_games == null) {
            $id_games[0]->id_games = "${id}";
        } else if(!str_contains($id_games[0]->id_games, $id)) {
            $id_games[0]->id_games = $id_games[0]->id_games." | ${id}";
        } else {
            $failUpdate = "true";
        }
        
        
        DB::table('list_games')->where("name","=",$request["list"] )->where("id_user", "=", Auth::id())->update([
            "id_games" => $id_games[0]->id_games
        ]);

        if (isset($request["specialSearch"])) {
            
           $search = $this->search($request["specialSearch"],$sizePage,'','','','',$actualPage);
        } else {
            $search = '';
        }
        return redirect()->back()->with("failUpdate", $failUpdate)->with("search", $search)->with("sizePage",$sizePage)->with("actualPage",$actualPage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,$id)
    {

        
        if(isset($request) && $request["list"]) {

            $listGames = DB::table('list_games')->where("name","=",$request["list"] )->where("id_user", "=",Auth::id())->pluck("id_games");
            $arrayIdGames = explode(' | ', $listGames[0]);
            $newArrayIdGames = "";
            foreach ($arrayIdGames as $key) {
                if ($key != $id) {
                    if ($key === array_key_first($arrayIdGames) | $newArrayIdGames == '') {
                        $newArrayIdGames = $key;
                    } else {
                        $newArrayIdGames .= " | ${key}";
                    }
                    
                }
            }
            DB::table('list_games')->where("name","=",$request["list"] )->where("id_user", "=", Auth::id())->update([
                "id_games" => $newArrayIdGames
            ]);

            return redirect()->route("list.load",$request["list"]);
        }
    }
}
