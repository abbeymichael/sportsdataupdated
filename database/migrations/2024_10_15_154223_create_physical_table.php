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
        Schema::create('physicals', function (Blueprint $table) {
            $table->id();  // Primary key (auto-incrementing)
            $table->unsignedBigInteger('player_id');  // Foreign key to players table
            $table->tinyInteger('aggression');  // Aggression rating
            $table->tinyInteger('strength');  // Strength rating
            $table->tinyInteger('explosiveness');  // Explosiveness rating
            $table->tinyInteger('power');  // Power rating
            $table->tinyInteger('change_of_pace');  // Change of pace rating
            $table->tinyInteger('ball_protection');  // Ball protection rating
            $table->tinyInteger('jumping');  // Jumping rating
            $table->tinyInteger('stamina');  // Stamina rating
            $table->tinyInteger('aerobic_capacity');  // Aerobic capacity rating
            $table->tinyInteger('speed');  // Speed rating
            $table->tinyInteger('agility');  // Agility rating
            $table->tinyInteger('balance');  // Balance rating
            $table->tinyInteger('acceleration');  // Acceleration rating
            $table->tinyInteger('repeated_sprint_ability');  // Repeated sprint ability rating
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
        Schema::dropIfExists('physical');
    }
};
