<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Publisher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CountrySeeder::class,
            PublisherSeeder::class,
            GenreSeeder::class,
            AuthorSeeder::class,
            BookSeeder::class,
            ]);

//        // Update publishers with country_id based on existing country_code
//        $publishers = Publisher::all();
//        foreach ($publishers as $publisher) {
//            $country = Country::where('code_3', $publisher->country_code)->first();
//            if ($country) {
//                $publisher->country_id = $country->id;
//                $publisher->save();
//            }
//        }
    }
}
