<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Home extends Controller
{

    public function index(){
        $db = DB::select("select * from views");
        $teams = [];
        $averageScores = [];
        foreach($db as $view){
            if (!in_array($view->pov, $teams)){
                array_push($teams, $view->pov);
            }
        }

        foreach($teams as $team){
            $averageScores[$team] = calculateAverageScore($team);

        }
        arsort($averageScores);
        return view("home", ["scores"=>$averageScores]);
    }
}

