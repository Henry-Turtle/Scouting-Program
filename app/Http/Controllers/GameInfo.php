<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameInfo extends Controller
{
    public function index($view_id){
        $db = DB::select("select * from views where id=$view_id");
        return view("game_info", ["view"=>$db]);
    }
}
