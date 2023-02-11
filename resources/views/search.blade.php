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

<script defer>
function search(){
    let team_id = document.getElementById("team").value
    window.location.href = "/search/" + team_id
}

</script>
<div style = "display: flex; flex-direction: row; height: 10%">
<?php echo '<input type = "text" placeholder="'.$placeholder.'" id = "team">'?>
<input type = "submit" id = "submit" onclick = "search()" value = "Submit">
</div>
<div id = "matches">
<?php 
//$plucked = $db->pluck("id", "teams");
foreach($db as $entry){
    $points = calculateScore($entry, DB::select("select * from views where match_id=$entry->match_id and pov!=$entry->pov"));
    $acc = missPercent($entry);
    echo "<h2 onclick = 'click(this)' id = '" .$entry->pov. "'>" .$entry->pov. ": " .$points. ", " .$acc. " % accuracy</h2>";
}

?>
</div>
@endsection