<?php

use App\Models\Genre;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    public const GENRES_MAX_COUNT = 10;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->delete();
        $faker = Faker::create();

        for ($i = 1; $i <= self::GENRES_MAX_COUNT; $i++) {
            Genre::query()->create([
                'id'   => $i,
                'name' => $faker->sentence(1),
            ]);
        }
    }
}
