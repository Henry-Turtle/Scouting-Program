@extends('layouts.sidebar')

@section("head")
<link href =  {{ asset("css/game_info.css") }} rel = "stylesheet">
<script src = {{ asset("js/game_info.js") }} defer></script>
@endsection

@section("content")

<h1>{{ $view->pov }}</h1>

<?php 

?>


<!--Define the table to show moves-->
<div id = "field">
    <div class = "terminals">
        <div class = "t1 blue">H</div>
        <div class = "t2 red">1</div>
    </div>

    <div id = "center">

        <div class = 'row'>
            <div class = 'junction' id = '11' data-cones='0'></div>
            <div class = 'junction' id = '21' data-cones='0'></div>
            <div class = 'junction' id = '31' data-cones='0'></div>
            <div class = 'junction' id = '41' data-cones='0'></div>
            <div class = 'junction' id = '51' data-cones='0'></div>
            </div>
            <div class = 'row'>
            <div class = 'junction' id = '12' data-cones='0'></div>
            <div class = 'junction' id = '22' data-cones='0'></div>
            <div class = 'junction' id = '32' data-cones='0'></div>
            <div class = 'junction' id = '42' data-cones='0'></div>
            <div class = 'junction' id = '52' data-cones='0'></div>
            </div>
            <div class = 'row'>
            <div class = 'junction' id = '13' data-cones='0'></div>
            <div class = 'junction' id = '23' data-cones='0'></div>
            <div class = 'junction' id = '33' data-cones='0'></div>
            <div class = 'junction' id = '43' data-cones='0'></div>
            <div class = 'junction' id = '53' data-cones='0'></div>
            </div>
            <div class = 'row'>
            <div class = 'junction' id = '14' data-cones='0'></div>
            <div class = 'junction' id = '24' data-cones='0'></div>
            <div class = 'junction' id = '34' data-cones='0'></div>
            <div class = 'junction' id = '44' data-cones='0'></div>
            <div class = 'junction' id = '54' data-cones='0'></div>
            </div>
            <div class = 'row'>
            <div class = 'junction' id = '15' data-cones='0'></div>
            <div class = 'junction' id = '25' data-cones='0'></div>
            <div class = 'junction' id = '35' data-cones='0'></div>
            <div class = 'junction' id = '45' data-cones='0'></div>
            <div class = 'junction' id = '55' data-cones='0'></div>
            </div>

    </div>

    <div class = "terminals">
        <div class = "t1 red">H</div>
        <div class = "t2 blue">1</div>
    </div>
</div>

<input hidden id = "alliance" value = "{{ $view->alliance }}">
<input hidden id = "moves" value = "{{ $view->moves }}">
@endsection