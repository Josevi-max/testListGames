<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function showDataUser()
    {
        $dataLists = DB::table("list_games")->where("id_user",Auth::id())->get(["name","id_games"]);
        foreach ($dataLists as $item) {
            $item->id_games = explode(" | ",$item->id_games);
        }
        $dataUser = DB::table('users')->where("id", Auth::id())->get();
        return view("settingsUser", compact("dataUser","dataLists"))->with("updateName", session("updateName"))->with("updateEmail", session("updateEmail"))->with("updatePassword", session("updatePassword"))->with("updateImage",session("updateImage"))->with("somethingFailed",session("somethingFailed"));
    }

    public function update(Request $request)
    {

        $updateName = false;
        $updateEmail = false;
        $updatePassword = false;
        $updateImage = false;
        $somethingFailed = true;
        if ($request->nameUser != Auth::user()->name) {
            DB::table('users')->where("id", Auth::id())->update([
                "name" => $request->nameUser
            ]);
            $updateName = true;
            $somethingFailed = false;
        }

        if ($request->email != $request->actualEmail) {
            if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                if (!DB::table('users')->where("email",$request->email)->exists()) {
                    DB::table('users')->where("id", Auth::id())->update([
                        "email" => $request->email
                    ]);
                    $updateEmail = true;
                    $somethingFailed = false;
                }
            }
        }

        if ($request->password!='' && $request->password === $request->repeatPassword && !Hash::check($request->password, $request->actualPassword)) {
            DB::table('users')->where("id", Auth::id())->update([
                "password" =>  bcrypt($request->password)
            ]);
            $updatePassword = true;
            $somethingFailed = false;
        }

        if ($request->hasFile("imageProfile")) {
            $image         = $request->file("imageProfile");
            $formats = ["jpg", "png", "gif"];
            if (in_array($image->extension(),$formats)) {
                $nameImage   = Auth::id().$image->extension();
                $route           = public_path("img/post/");
                $image->move($route, $nameImage);
                $updateImage = true;
                $somethingFailed = false;

                DB::table('users')->where("id",Auth::id())->update([
                    "profile" => $nameImage
                ]);
            }
            
            
            
        }

        return back()->with("updateName", $updateName)->with("updateEmail", $updateEmail)->with("updatePassword", $updatePassword)->with("updateImage",$updateImage)->with("somethingFailed",$somethingFailed);
    }

    public function delete () {
        DB::table('users')->where("id", Auth::id())->delete();

        return back();
    }
}
