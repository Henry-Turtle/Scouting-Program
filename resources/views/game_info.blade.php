@extends('layouts.sidebar')

@section("head")
<link href =  {{ asset("css/game_info.css") }} rel = "stylesheet">
<script src = {{ asset("js/game_info.js") }}></script>
@endsection

@section("content")

<h1>{{ $db->pov }}</h1>

<?php 

$moves = json_decode($db->moves);

?>

<script>
    const moves = {{ JS::from($views) }}
</script>

<table>
    <tr>
        <td id = "11"></td>
        <td id = "21"></td>
        <td id = "31"></td>
        <td id = "41"></td>
        <td id = "51"></td>
    </tr>
    <tr>
        <td id = "12"></td>
        <td id = "22"></td>
        <td id = "32"></td>
        <td id = "42"></td>
        <td id = "52"></td>
    </tr>
    <tr>
        <td id = "13"></td>
        <td id = "23"></td>
        <td id = "33"></td>
        <td id = "43"></td>
        <td id = "53"></td>
    </tr>
    <tr>
        <td id = "14"></td>
        <td id = "24"></td>
        <td id = "34"></td>
        <td id = "44"></td>
        <td id = "54"></td>
    </tr>
    <tr>
        <td id = "15"></td>
        <td id = "25"></td>
        <td id = "35"></td>
        <td id = "45"></td>
        <td id = "55"></td>
    </tr>
    
</table>
