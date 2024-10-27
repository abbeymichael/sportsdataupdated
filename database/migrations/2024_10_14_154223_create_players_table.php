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
        Schema::create('players', function (Blueprint $table) {
            $table->id();  // Primary key (auto-incrementing)
        $table->unsignedBigInteger('club_id');  
        $table->string('name');
        $table->date('dob');  // Date of birth
        $table->float('height');  // Height
        $table->float('weight');  // Weight
        $table->string('position');  // Position on the field
        $table->enum('preferred_foot', ['left', 'right']);  // Preferred foot (left or right)
        $table->string('image')->nullable();
        $table->timestamps();  // created_at and updated_at timestamps

        // Foreign key constraint
        $table->foreign('club_id')->references('id')->on('clubs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
