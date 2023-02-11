<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("views", function(Blueprint $table){


            
            $table->string("pov");
            $table->string("alliance");
            $table->string("teams");     
            $table->text("moves");
            $table->integer("match_id")->nullable();

            $table->bigIncrements("id");    
            $table->date("created_at");
            $table->date("updated_at"); 

            $table->dateTime("uploaded_at")->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
