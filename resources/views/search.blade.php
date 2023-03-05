@extends("layouts.sidebar")

@section("head")
<link href =  "/css/search.css" rel = "stylesheet">
<script defer src = "/js/search.js"></script>
@endsection

@section("content")
<?php
if($team_id == ""){
    $placeholder = "Enter Team ID";
}
else{
    $placeholder = $team_id;
}
?>

<div style = "display: flex; flex-direction: row; height: auto; margin-top: 20px;">
<?php echo '<input type = "text" placeholder="'.$placeholder.'" id = "team">'?>
<input type = "submit" id = "submit" onclick = "search()" value = "Submit">
</div>
<div id = "matches">
<?php 
//$plucked = $db->pluck("id", "teams");
foreach($db as $entry){
    // Returns a game element for the view

    echo "<button class = 'game' id = '$entry->id'onclick = 'getGame(this)'>";
    if ($entry->match_id != null){
        $points = calculateScore($entry);
    }
    else{
        $points = calculateScore($entry);
    }
    
    $acc = accuracyPercent($entry);

    //puts the POV team onto the button
    echo "<h2 class = 'pov' style = 'color: $entry->alliance;'>Team $entry->pov </h2>";

    
    //Puts the other teams on the button
    echo "<div class = 'otherTeams'>";
    foreach(explode( ",", $entry->teams) as $otherTeam){
        if(!($otherTeam === $entry->pov)){
            echo "<h2 style = 'font-size: 1.6vh; user-select: none;'>$otherTeam</h2>";
        }
    }
    echo "</div>";

    //Puts score and accuracy on the button
    $score = calculateScore($entry);
    echo "<h2 class = 'score'>Score: $score</h2>";
    $accuracy = accuracyPercent($entry);
    echo "<h2 class = 'accuracy'>Accuracy: $accuracy%</h2>";
    
   
    echo "</button>";
}

?>
</div>
@endsection