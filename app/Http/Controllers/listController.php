<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Helpers\Api;
class listController extends Controller
{
    use Api;
    public function index()
    {
        $list = DB::table('list_games')->where('id_user', '=', Auth::id())->get("name");
        $gamesList = '';
        $emptyList = '';
        $actualListGames = '';
        $dataGamesList = '';
        if (session("paginate")) {
            $gamesList = session("paginate");
            $dataGamesList = session("dataGamesList");
        }
        if (session("isEmpty")) {
            $emptyList = session("isEmpty");
        }

        if (session("actualList")) {
            $actualListGames = session("actualList");
        }
        
        return view("listGames", compact("list", "gamesList", "emptyList", "actualListGames","dataGamesList"));
    }

    public function load($name)
    {
        $existList = DB::table('list_games')->where("name", "=", $name)->where("id_user", "=", Auth::id())->exists();
        $actualList = $name;
        $dataGamesList = [];
        $paginate = [];
        $isEmpty = false;
        if ($existList) {
            $listIdGames = DB::table('list_games')->where("name", "=", $name)->where("id_user", "=", Auth::id())->pluck("id_games");
            if ($listIdGames[0]) {
                $arrayIdGames = explode(' | ', $listIdGames[0]);
                
                for ($i = 0; $i < count($arrayIdGames); $i++) {

                    $callApi = Http::get("https://api.rawg.io/api/games/$arrayIdGames[$i]?key=6c89b42c4215483c8ab7488dcafe2f2a")->json();
                    $dataGamesList += [
                        $i => [
                            "name" => $callApi["name"],
                            "image" => $callApi["background_image"],
                            "id" => $callApi["id"]
                        ]
                    ];
                }

                $paginate = $this->paginate($dataGamesList,6,'list/'.$actualList);
            } else {
                $isEmpty = true;
            }
        }
        return redirect()->route("list.index")->with("paginate", $paginate)->with("actualList", $actualList)->with("isEmpty", $isEmpty)->with("dataGamesList",$dataGamesList);
    }

    public function delete(Request $request)
    {
        DB::table('list_games')->where('id_user', '=', Auth::id())->where('name', '=', $request['list'])->delete();
        return redirect()->route('list.index');
    }
}
