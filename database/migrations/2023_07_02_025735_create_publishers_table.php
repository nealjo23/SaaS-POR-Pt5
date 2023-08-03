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
        Schema::create('publishers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('UNKNOWN');
            $table->string('city')->default('UNKNOWN');
//            $table->char('country_code', 3)->nullable();
            $table->unsignedBigInteger('country_id')->nullable(); // Add country_id column
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('SET NULL');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publishers');
    }
};
