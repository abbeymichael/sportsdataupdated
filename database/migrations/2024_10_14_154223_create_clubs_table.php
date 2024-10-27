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
        Schema::create('clubs', function (Blueprint $table) {
            $table->id();  // Primary key (auto-incrementing)
            $table->string('name');  // Club name
            $table->string('country');  // Country
            $table->string('city');  // City
            $table->string('stadium_name')->nullable();  // Stadium name (optional)
            $table->integer('founded_year')->nullable();  // Year club was founded (optional)
            $table->string('manager')->nullable();  // Manager name (optional)
            $table->timestamps();  // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clubs');
    }
};
