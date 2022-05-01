<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Helpers\Api;
class friendsController extends Controller
{
    Use Api;
    public function index() {
        $petitionsFriends = DB::table('friends')->where("friend",Auth::id())->where("state",0)->get()->toArray();
        $friends = DB::table('friends')->where("friend",Auth::id())->orWhere("id_user",Auth::id())->where("state",1)->get()->toArray();
        $dataFriendsPetitions = [];
        $dataFriends = [];
        foreach ($petitionsFriends as $item) {
            array_push($dataFriendsPetitions,DB::table('users')->where("id",$item->id_user)->get());
        }
        foreach ($friends as $item) {
            if ($item->id_user != Auth::id()) {
                array_push($dataFriends,DB::table('users')->where("id",$item->id_user)->get());
            } else {
                array_push($dataFriends,DB::table('users')->where("id",$item->friend)->get());
            }
        }
        //$dataFriends = $this->paginate($dataFriends,2);
        return view("friends",compact("dataFriendsPetitions","dataFriends"))->with("delete",session("delete"))->with("update",session("update"));
    }

    public function friendsPetition (Request $request) {
        $idUser = Auth::id();
        $idFriend =$request["id_friend"];
        DB::table('friends')->insert([
            "id_user" => $idUser,
            "state" => 0,
            "friend" => $idFriend
        ]);
        return back()->with("petition",true);
    }

    public function AccepteFriend (Request $request) {
        DB::table('friends')->where("id_user",$request["id"])->where("friend",Auth::id())->update([
            "state" => 1
        ]);
        return back()->with("update",true);
    }

    public function deleteFriend (Request $request) {
        DB::table('friends')->where("id_user",$request["id"])->where("friend",Auth::id())->delete();
        return back()->with("delete",true);
    }
}
