<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            ["id" => 1, "name" => "Unknown", "description" => ""],
            ["id" => 10, "name" => "Science", "description" => ""],
            ["id" => 11, "name" => "Novel", "description" => ""],
            ["id" => 12, "name" => "Philosophy", "description" => ""],
            ["id" => 2, "name" => "Fiction", "description" => ""],
            ["id" => 3, "name" => "Non-Fiction", "description" => ""],
            ["id" => 4, "name" => "Autobiography", "description" => ""],
            ["id" => 5, "name" => "Science Fiction", "description" => ""],
            ["id" => 6, "name" => "History", "description" => ""],
            ["id" => 7, "name" => "Technical", "description" => ""],
            ["id" => 8, "name" => "LGBTQI+", "description" => ""],
            ["id" => 9, "name" => "Classic", "description" => ""],
        ];
        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
}
