<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [[
            'code' => 'Travel',
            'description' => 'Travel description'
        ],
        [
            'code' => 'Music',
            'description' => 'Music description'
        ],
        [
            'code' => 'Food',
            'description' => 'Food description'
        ],
        [
            'code' => 'Design',
            'description' => 'Design description'
        ],
        [
            'code' => 'Fitness',
            'description' => 'Fitness description'
        ],
        [
            'code' => 'Economics',
            'description' => 'Economics description'
        ],];

        foreach ($categories as $category) {
            $newCategory = Category::create($category);
        }
    }
}
