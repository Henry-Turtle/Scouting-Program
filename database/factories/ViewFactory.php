<?php

namespace Database\Factories;

use app\Models\View;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\View>
 */
class ViewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = View::class;
    public function definition()
    {
        return [
            "pov" => 11111,
            "alliance" => "blue",
            "teams" => "11111,22222,33333,44444",
            "moves" => "[{}]",
            "match_id" => null,
            "id" => 0,
            "created_at" => now(),
            "updated_at" => now(),
            "uploaded_at" => null, 
        ];
    }
}
