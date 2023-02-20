<?php

namespace Tests\Unit;

use App\Models\View;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatsTest extends TestCase
{
    use RefreshDatabase;


    /**
     * & UNIT TESTS
     * & missPercent takes in a single database entry, outputs integer miss percentage rounded to two decimals
     * & CASES:
     * & $entry is a valid, normal entry
     * & $entry is null
     * & $entry->moves is empty array []
     *
     * @return void
     */
    public function test_accuracy_percent()
    {

        $standardView = View::factory(["moves"=>'[{"coneType":"miss","location":"23","height":"high","timestamp":"57.75"},{"coneType":"cone","location":"60","height":"terminal","timestamp":"125.09"}]'])->make();
        $this->assertEquals(50.00, accuracyPercent($standardView));
    }
    public function test_no_moves_accuracy_percent(){
        $noMovesView = View::factory()->make();
        $this->assertEquals(0.00, accuracyPercent($noMovesView));
    }

    public function test_null_accuracy_percent(){
        $nullView = null;
        $this->assertEquals(0.00, accuracyPercent($nullView));
    }
    public function test_null_calculate_score(){

        $nullView = [];
        $nullOtherViews = [];

        $this->assertEquals(0.00, calculateScore($nullView, $nullOtherViews));

        
    }
    public function test_no_moves_calculate_Score(){
        $noMoves = View::factory()->make();
        $otherNoMoves = View::factory(3)->make();

        $this->assertEquals(0.00, calculateScore($noMoves, $otherNoMoves));
    }

    public function test_regular_calculate_score(){
        $regularView = View::factory(["moves"=>'[{"coneType":"cone", "location": "23", "timestamp":"10.00"}]'])->make();
        $regularOtherViews = [View::factory()->make(), View::factory()->make(), View::factory(["moves"=>'[{"coneType": "miss", "location":"23","timestamp":"9.00"}]'])->make()];
        
        $this->assertEquals(8.00, calculateScore($regularView, $regularOtherViews));
    }
    public function test_ownership_points(){
        $nullMoves = [];
        $nullEnemyMoves = [];
        $this->assertEquals(0, onwershipPoints($nullMoves, $nullEnemyMoves));
        
    }

    public function test_complex_ownership_points(){
        //TODO: Make a real game, copy the data over here, and see if it can calculate correctly
        //TODO I think everything works right and I can hold off on this
        //TODO: Make a mock database to store this complex game
    }
}
