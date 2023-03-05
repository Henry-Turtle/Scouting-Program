<?php

namespace App\Http\Controllers;

use App\Models\View;
use Illuminate\Http\Request;


class ScoutingController extends Controller
{
    public function index(Request $request){
        
        return view("scout", ["pov" => $request->input("pov"), "alliance" => $request->input("alliance"), "teams" => $request->input("teams")]);
    }

    public function store(Request $request){
        $view = new View();

        $view->match_id = null;
        $view->moves = json_encode(json_decode($request->input("actions")));
        $view->pov = $request->input("pov");
        $view->alliance = $request->input("alliance");
        $view->teams = $request->input("teams");
        
        //$view->uploaded_at = date("d/m/y H:i:s");
        $view->uploaded_at = null;
        $view->save();

        return redirect('home')->with('message', 'Game successfully saved');
}
}