@extends('layouts.sidebar')

@section("head")
<link href =  {{ asset("css/home.css") }} rel = "stylesheet">
@endsection

@section("content")

@if( session()->has('message') )
<?php $message = session('message') ?>

<?php echo "<div class = 'message'>$message </div>"?>

@endif
@if( session()->has('error'))
<?php $error = session('error'); ?>

<?php echo "<div class = 'error'>$error </div>";?>

@endif

<h1>Top Teams:</h1>

<div id = "leaderboard">
<?php 
foreach ($scores as $team => $score) {
    echo "<h1>$team average score: $score</h1>";
}
?>
</div>


@endsection