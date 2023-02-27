<?php

use Illuminate\Support\Facades\DB;



function accuracyPercent($entry)
{ //* Returns the percentage of total moves which were not misses
    if ($entry == null || $entry->moves == "[{}]") {
        return 0.00;
    }


    $moves = json_decode($entry->moves);

    $total = count($moves);
    $misses = 0;
    foreach ($moves as $move) {
        if ($move->coneType == "miss") {
            $misses++;
        }
    }

    if ($total == 0) {
        return 0;
    }
    return round(($total - $misses) / $total, 2) * 100;

    /*
    
    */


}

function getHeight(string $height)
{ //& Height is a string in form "xy"
    $coneX = substr($height, 0, 1);
    $coneY = substr($height, -1, 1);

    if ($coneX == "0" or $coneX == "6") { //* This will only happen in case terminal, and will always happen in case terminal
        return "terminal";
    }

    if ($coneY == "1" or $coneY == "5") {
        if ($coneX == "1" or $coneX == "3" or $coneX == "5") {
            return "ground";
        }
        if ($coneX == "2" or $coneX == "4") {
            return "low";
        }
    }

    if ($coneY == "2" or $coneY == "4") {
        if ($coneX == "1" or $coneX == "5") {
            return "low";
        }
        if ($coneX == "2" or $coneX == "4") {
            return "medium";
        }
        if ($coneX == "3") {
            return "high";
        }
    }

    if ($coneY == "3") {
        if ($coneX == "1" or $coneX == "3" or $coneX == "5") {
            return "ground";
        }
        if ($coneX == "2" or $coneX == "4") {
            return "high";
        }
    }


    /*
    & UNIT TESTS
    & $height is not type string
    & $height is not length 2
    & $height is null
    & $height has non-int components
    */
}
// @moves: All the moves in the view
// @otherPlayerMoves: The moves from all other teams in the match
function onwershipPoints($moves, $otherPlayerMoves)
{

    
    $totalPoints = 0;
    foreach ($moves as $move) {
        $getsOwnershipPoints = true;

        $timestamp = $move->timestamp;
        $coneType = $move->coneType;
        $location = $move->location;

        if ($coneType == "beacon") {
            $totalPoints += 10;
            continue;
        }

        if ($coneType == "miss") {
            continue;
        }

        foreach ($moves as $playerOtherMove) {
            if ($playerOtherMove === $move)
                continue;

            $conflictingLocation = $playerOtherMove->location;
            $conflictingTimestamp = $playerOtherMove->timestamp;

            if ($playerOtherMove->coneType == "miss") {
                continue;
            }

            if ($conflictingLocation == $location and (int) $conflictingTimestamp > (int) $timestamp) {
                $getsOwnershipPoints = false;
                break;
            }
        }
        foreach ($otherPlayerMoves as $player) {
            if (sizeof($player) == 0) continue;
            foreach ($player as $conflictingMove) {
                if ($conflictingMove == new stdClass()) continue; //*This catches if movelist is empty
                 
                $opponentLocation = $conflictingMove->location;
                $opponentTimestamp = $conflictingMove->timestamp;

                if ($conflictingMove->coneType == "miss") {
                    continue;
                }

                if ($opponentLocation == $location && ($conflictingMove->coneType == "beacon" || (int) $opponentTimestamp > (int) $timestamp)) {
                    $getsOwnershipPoints = false;
                    break;
                }
            }
        }

        if ($getsOwnershipPoints){
            $totalPoints += 3;  
        }
        
    }


    return $totalPoints;

    /*
    & Unit tests
    & If $moves is null or []
    */

}

function calculateScore($entry)
{
    $score = 0;
    if ($entry == [] || $entry->moves == "[{}]") return 0;

    $moves = json_decode($entry->moves);

    if ($entry->match_id == null){
        $otherEntries = [];
    }
    else{
        $otherEntries = DB::select("select * from views where match_id=$entry->match_id and pov!=$entry->pov");
    }


    $otherMoves = array();
    for ($x = 0; $x < sizeof($otherEntries); $x++) {
        $otherMoves[$x] = json_decode(($otherEntries[$x]->moves));
    }

    foreach ($moves as $move) {
        if ($move->coneType == "miss") {
            continue;
        }

        switch (getHeight($move->location)) {
            case "terminal":
                $score += 1;
                break;
            case "ground":
                $score += 2;
                break;
            case "low":
                $score += 3;
                break;
            case "medium":
                $score += 4;
                break;
            case "high":
                $score += 5;
                break;
        }

    }
    $score += onwershipPoints($moves, $otherMoves);

    return $score;

    /*
    & UNIT TESTS
    & If $entry is null or []
    & If $otherEntries is null or []
    & If $otherEntries is not length 4, may be length 0-4
    */
}

//!Not unit tested!
function calculateAverageScore($teamID)
{
    $views = DB::select("select * from views where pov=$teamID");
    $totalScore = 0;
    $numViews = sizeof($views);

    if ($numViews == 0){
        return 0;
    }

    foreach ($views as $view) {
        $totalScore += calculateScore($view);
    }
    return $totalScore/$numViews;

}




?>