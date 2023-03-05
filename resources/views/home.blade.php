@extends('layouts.sidebar')

@section("head")
<link href =  {{ asset("css/home.css") }} rel = "stylesheet">
<script src =  {{ asset("js/home.js") }} defer></script>
@endsection

@section("content")

@if( session()->has('message') )
<?php $message = session('message') ?>

<?php echo "<div class = 'message'>$message</div>"?>

@endif
@if( session()->has('error'))
<?php $error = session('error'); ?>

<?php echo "<div class = 'error'>$error</div>";?>

@endif

<h1>Top Scoring Teams:</h1>

<div id = "leaderboard">
<?php 
foreach ($scores as $team => $score) {
    echo "<button class = 'team' id = '$team' style = 'user-select: none' onclick = 'showTeam(this)'>Team $team: $score points</button>";
}
?>
</div>


@endsection