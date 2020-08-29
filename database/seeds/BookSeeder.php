<?php

use App\Models\Book;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    const BOOKS_MAX_COUNT = 100;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('book_authors')->delete();
        DB::table('books')->delete();

        $faker = Faker::create();

        for ($i = 1; $i <= self::BOOKS_MAX_COUNT; $i++) {
            Book::query()->create([
                'id'          => $i,
                'name'        => $faker->sentence(1),
                'description' => $faker->sentence(5),
                'genre_id'    => $faker->numberBetween(1, GenreSeeder::GENRES_MAX_COUNT),
            ]);
        }

        for ($i = 0; $i < self::BOOKS_MAX_COUNT; $i++) {
            DB::table('book_authors')->insert([
                'book_id'   => $faker->numberBetween(1, self::BOOKS_MAX_COUNT),
                'author_id' => $faker->numberBetween(1, AuthorSeeder::AUTHOR_MAX_COUNT),
            ]);
        }
    }
}
