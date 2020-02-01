<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Laravel',
        ]);

        Category::create([
            'name' => 'PHP',
        ]);

        Category::create([
            'name' => 'NodeJS',
        ]);

        Category::create([
            'name' => 'WordPress',
        ]);

        Category::create([
            'name' => 'Pusher',
        ]);

        Category::create([
            'name' => 'VueJS',
        ]);

        Category::create([
            'name' => 'Python',
        ]);
    }
}
