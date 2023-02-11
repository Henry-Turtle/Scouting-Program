@extends("layouts.sidebar")

@section("head")
<link rel = "stylesheet" href = {{ asset("css/new_match.css") }}>
<script src = {{ asset("js/new_match.js") }}></script>
@endsection

@section("content")
<h1>New Match</h1>
<div id = "match">

        <label for = "pov">Team ID: </label>
        <input id = "pov_entry" placeholder="Enter ID">
        <div id = "color">
            <button value = "blue" id = "blue" class = "color-btn selected" onclick = "clicked(this)"></button>
            <button value = "red" id = "red" class = "color-btn" onclick = "clicked(this)"></button>
        </div>

        <label for = "t2">IDs of other teams: </label>
        <input id = "t2" placeholder="Enter ID">
        <input id = "t3"placeholder="Enter ID">
        <input id = "t4"placeholder="Enter ID">

        <input type = "submit" id = "submit" value = "Begin" onclick = "beginScout()">
</div>

<form id = "hidden" action = "/scouting" method = "GET">
    @csrf <!-- {{ csrf_field() }} -->
</form>
@endsection