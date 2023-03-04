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
    echo "<div class = 'team'>$team average score: $score</div>";
}
?>
</div>


@endsection