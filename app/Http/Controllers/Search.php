<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Search extends Controller
{
    public function index(){        
        return view("search", 
        [
            "db" => DB::table("views")->get(),
            "team_id" => null
        ]);
        
    }

    public function show($team_id){
        //$db = DB::select("select * from views where pov like '%$team_id%'");
        $db = DB::select("select * from views where pov=$team_id");
        $team_id = (int)$team_id;
        
        return view("search",
        [
            "db" => $db,
            "team_id" => $team_id
        ]
        );
    }
}
?>