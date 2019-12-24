<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach(range(1,5) as $id)
        {
            Category::insert([
                'id' => $id,
                'name' => $faker->sentence(3)
            ]);
        }
    }
}
