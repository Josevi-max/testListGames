<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class addListGamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = DB::table('list_games')->where("id_user","=",Auth::id())->get("name");
        return view("listGames",compact("list"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(session("failQuery")) {
            $failQuery = session("failQuery");
        }

        if(session("search")) {
            $search = session("search");
        }

        if(session("update")) {
            $update = session("update");
        }

        $listsUser = DB::table('list_games')->where('id_user', '=', Auth::id())->get("name");

        return view("createList", compact(
            "listsUser",
             isset($failQuery)?"failQuery":null,
             isset($search)?"search":null,
             isset($update)?"update":null
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

        $failQuery = "false";
        $nameList = $request['name_list'];
        if (!DB::table('list_games')->where('name', '=', $nameList )->where('id_user', '=', Auth::id())->exists()) {
            if (!DB::table('list_games')->insert([
                "name" => $request['name_list'],
                "id_user" => Auth::id()])) {
                    $failQuery = "true";
            }
        } else {
            $failQuery = "true";
        }

        return redirect()->route("list.create")->with("failQuery", $failQuery);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {

        $existList = DB::table('list_games')->where("name", "=", $name)->where("id_user", "=", Auth::id())->exists();
        if($existList) {
            $listIdGames = DB::table('list_games')->where("name", "=", $name)->where("id_user", "=", Auth::id())->pluck("id_games");
            $arrayIdGames = explode(' | ', $listIdGames[0]);
            $dataGamesList = [];
            foreach ($arrayIdGames as $key ) {
                $callApi = Http::get("https://api.rawg.io/api/games/${key}?key=6c89b42c4215483c8ab7488dcafe2f2a")->json();
                $dataGamesList += [
                   "name" => $callApi["name"] ,
                   "description" => $callApi["description"] ,
                   "metacritic" => $callApi["metacritic"] ,
                   "image" => $callApi["background_image"]
                ];
                
               
            }

            
            
        }

        return $dataGamesList;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $id_games = DB::table('list_games')->where("name","=",$request["list"] )->get("id_games");
        $update = "true";

        if ($id_games[0]->id_games == null) {
            $id_games[0]->id_games = "${id}";
        } else if(!str_contains($id_games[0]->id_games, $id)) {
            $id_games[0]->id_games = $id_games[0]->id_games." | ${id}";
        } else {
            $update = "false";
        }
        
        
        DB::table('list_games')->where("name","=",$request["list"] )->update([
            "id_games" => $id_games[0]->id_games
        ]);
        return redirect()->route("list.create")->with("update", $update);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
