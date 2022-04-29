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
    public function index($id = '')
    {
        $list = DB::table('list_games')->where('id_user', '=', empty($id) ? Auth::id() : $id)->get("name");
        $idUser = $id;
        $gamesList = '';
        $emptyList = '';
        $actualListGames = '';
        $dataGamesList = '';
        $canEdit = '';
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

        if (session("canEdit")) {
            $canEdit = session("canEdit");
        }

        return view("listGames", compact("list", "gamesList", "emptyList", "actualListGames", "dataGamesList", "idUser", "canEdit"));
    }

    public function load($name, $id)
    {
        $actualList = $name;
        $dataGamesList = [];
        $paginate = [];
        $isEmpty = false;
        $canEdit = ($id == Auth::id());
        $listIdGames = DB::table('list_games')->where("name", "=", $name)->where("id_user", "=", $id)->pluck("id_games");
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
            $paginate = $this->paginate($dataGamesList, 6);
        } else {
            $isEmpty = true;
        }
        return redirect()->route("list.index", $id)->with("paginate", $paginate)->with("actualList", $actualList)->with("isEmpty", $isEmpty)->with("dataGamesList", $dataGamesList)->with("canEdit", $canEdit);
    }

    public function delete(Request $request)
    {
        DB::table('list_games')->where('id_user', '=', Auth::id())->where('name', '=', $request['list'])->delete();
        return back();
    }
}
