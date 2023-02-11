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

        $noMovesView = View::factory()->make();
        $this->assertEquals(0.00, accuracyPercent($noMovesView));

        $nullView = null;
        $this->assertEquals(0.00, accuracyPercent($nullView));
        
    }

    public function test_ownership_points(){
        $nullMoves = [];
        $nullEnemyMoves = [];
        $this->assertEquals(0, onwershipPoints($nullMoves, $nullEnemyMoves));
        
    }
}
