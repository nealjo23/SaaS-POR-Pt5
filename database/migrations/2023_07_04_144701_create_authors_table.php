<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * '' => 'Kevin',   '' => 'Potts',            ''
    $table->string('city')->default('UNKNOWN');
     *
     *
     */
    public function up(): void
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('given_name')->default('UNKNOWN');
            $table->string('family_name')->default('UNKNOWN');
            $table->boolean('is_company')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
