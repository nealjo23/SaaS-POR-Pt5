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
        Schema::table('books', function (Blueprint $table) {
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('restrict');
            $table->foreign('publisher_id')->references('id')->on('publishers')->onDelete('restrict');
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('restrict');
            $table->foreign('sub_genre_id')->references('id')->on('genres')->onDelete('restrict');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropForeign(['publisher_id']);
            $table->dropForeign(['genre_id']);
            $table->dropForeign(['sub_genre_id']);
        });
    }


};
