<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showDataUser () {

        $dataUser = DB::table('users')->where("id",Auth::id())->get();
        return view("settingsUser",compact("dataUser"))->with("updateName",session("updateName"))->with("updateEmail",session("updateEmail"))->with("updatePassword",session("updatePassword"));
    }

    public function update (Request $request) {

        $updateName = false;
        $updateEmail = false;
        $updatePassword = false;
        if ($request->nameUser != $request->actualName) {
            DB::table('users')->where("id",Auth::id())->update([
                "name" => $request->nameUser
            ]);
            $updateName = true;
        }

        if ($request->email != $request->actualEmail) {
            DB::table('users')->where("id",Auth::id())->update([
                "email" => $request->email
            ]);
            $updateEmail = true;

        }

        if ($request->password === $request->repeatPassword && !Hash::check($request->password, $request->actualPassword)) {
            DB::table('users')->where("id",Auth::id())->update([
                "password" =>  bcrypt($request->password)
            ]);
            $updatePassword = true;
        }

        return back()->with("updateName",$updateName)->with("updateEmail",$updateEmail)->with("updatePassword",$updatePassword);
    }
}
