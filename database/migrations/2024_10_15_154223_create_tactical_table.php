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
        Schema::create('tactical', function (Blueprint $table) {
            $table->id();  // Primary key (auto-incrementing)
            $table->unsignedBigInteger('player_id');  // Foreign key to players table
            $table->tinyInteger('vision');  // Vision rating (1-10)
            $table->tinyInteger('positioning');  // Positioning rating
            $table->tinyInteger('ability_to_loose_marker');  // Ability to lose marker rating
            $table->tinyInteger('counter_attack');  // Counter attack rating
            $table->tinyInteger('unpredictability');  // Unpredictability rating
            $table->tinyInteger('read_the_game');  // Reading the game rating
            $table->tinyInteger('space_creation');  // Space creation rating
            $table->tinyInteger('tactical_awareness');  // Tactical awareness rating
            $table->tinyInteger('support_play');  // Support play rating
            $table->tinyInteger('creativity');  // Creativity rating
            $table->tinyInteger('defensive_ability');  // Defensive ability rating
            $table->tinyInteger('receive_ball_under_pressure');  // Receiving the ball under pressure rating
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
        Schema::dropIfExists('tactical');
    }
};
