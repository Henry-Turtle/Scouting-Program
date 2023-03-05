<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamInfo extends Controller
{
    public function index($team_id){
        return view("team_info", 
        [   
            "team_id"=>$team_id,
            "views"=>DB::select("select * from views where pov=$team_id")
        ]);
    }
}
