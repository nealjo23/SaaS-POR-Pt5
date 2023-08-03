<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title')->required();
            $table->string('subtitle')->nullable();
            $table->Integer('year_published')->zerofill()->nullable();
            $table->integer('edition')->nullable();
            $table->string('isbn_10', 10)->nullable();
            $table->string('isbn_13', 13)->nullable();
            $table->unsignedBigInteger('author_id')->nullable();
            $table->unsignedBigInteger('genre_id')->nullable();
            $table->unsignedBigInteger('sub_genre_id')->nullable();
            $table->unsignedBigInteger('publisher_id')->nullable();
            $table->smallInteger('height')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
