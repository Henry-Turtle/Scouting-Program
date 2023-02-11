<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Matches;

class Sync extends Controller
{
    public function index(){

        $views = DB::select('select pov, alliance, teams, moves, match_id, id, created_at, updated_at from views where match_id is null');
        
        return view("sync", ["views" => $views]);
    }

    public function store(Request $request){
        $tasks = json_decode($request->input("queues"));

        foreach($tasks as $task){
            $task = json_decode($task);
            
            
            if(sizeof($task)==7){
                $affected = DB::table("views")->where("created_at", $task[5])->where("pov", $task[1])->update(["match_id" => $task[0]]);
                
            }
            if(sizeof($task)==4){
                $match = new Matches();

                $match->match_id = $task[0];
                $match->teams = $task[1];
                
                $match->save();
            }
            
        }

        return redirect("home")->with("message", "Data successfully synced with server!");
        

    }
}
