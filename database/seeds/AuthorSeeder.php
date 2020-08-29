<?php

use App\Models\Author;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    public const AUTHOR_MAX_COUNT = 100;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('authors')->delete();
        $faker = Faker::create();

        for ($i = 1; $i <= self::AUTHOR_MAX_COUNT; $i++) {
            Author::query()->create([
                'id'   => $i,
                'name' => $faker->name,
            ]);
        }
    }
}
