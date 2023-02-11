<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewMatch extends Controller
{
    public function index(){
        return view("new_match");
    }
}
