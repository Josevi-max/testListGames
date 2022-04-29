<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class comunityController extends Controller
{
    public function index() {
        if (session("resultsUsers")) {
            $dataUsers = session("resultsUsers");
        } else {
            $dataUsers = DB::table('users')->where("id","!=", Auth::id())->paginate(6);
        }
        
        return view("comunnity",compact("dataUsers"));;
    }

    public function searchUser(Request $request) {
        if (empty($request["search"])) {
            return back();
        }
        $resultsUsers = DB::table('users')->where("name",'like', "%" .$request["search"] . "%")->paginate(6);
        return redirect()->back()->with("resultsUsers", $resultsUsers);
    }
}
