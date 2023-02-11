<?php

namespace Database\Factories;

use app\Models\Matches;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Matches>
 */
class MatchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Matches::class;
    public function definition()
    {
        return [
            "match_id" => 1,
            "teams" => "00000,11111,22222,33333",
            "id" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ];
    }
}
