<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('technical', function (Blueprint $table) {
            $table->id();  // Primary key (auto-incrementing)
            $table->unsignedBigInteger('player_id');  // Foreign key to players table
            $table->tinyInteger('technique');  // Technique rating
            $table->tinyInteger('dribbling');  // Dribbling rating
            $table->tinyInteger('using_both_feet');  // Ability to use both feet rating
            $table->tinyInteger('ball_control');  // Ball control rating
            $table->tinyInteger('long_shots');  // Long shots rating
            $table->tinyInteger('pass_forward');  // Pass forward rating
            $table->tinyInteger('pass_sideways');  // Pass sideways rating
            $table->tinyInteger('pass_backwards');  // Pass backwards rating
            $table->tinyInteger('crossing');  // Crossing rating
            $table->tinyInteger('long_throws');  // Long throws rating
            $table->tinyInteger('heading');  // Heading rating
            $table->tinyInteger('finishing');  // Finishing rating
            $table->tinyInteger('play_under_pressure');  // Play under pressure rating
            $table->timestamps();  // created_at and updated_at timestamps
    
            // Foreign key constraint
            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technical');
    }
};
