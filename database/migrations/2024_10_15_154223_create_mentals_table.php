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
        Schema::create('mentals', function (Blueprint $table) {
            $table->id();  // Primary key (auto-incrementing)
        $table->unsignedBigInteger('player_id');  // Foreign key to players table
        $table->tinyInteger('leadership');  // Leadership rating
        $table->tinyInteger('temperament');  // Temperament rating
        $table->tinyInteger('error_handling');  // Error handling rating
        $table->tinyInteger('determination');  // Determination rating
        $table->tinyInteger('team_work');  // Teamwork rating
        $table->tinyInteger('decision_making');  // Decision making rating
        $table->tinyInteger('concentration');  // Concentration rating
        $table->tinyInteger('charisma');  // Charisma rating
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
        Schema::dropIfExists('mental');
    }
};
