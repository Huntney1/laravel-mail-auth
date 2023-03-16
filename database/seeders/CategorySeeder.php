<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category as Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [

            'Html',
            'Css',
            'Bootstrap',
            'javascript',
            'VueJs',
            'php',
            'laravel',
        ];

        foreach ($categories as $category){
            $newCategory = new Category ();
            $newCategory->name = $category;
            $newCategory->slug = Str::slug($newCategory->name, '-');

            $newCategory->save();
        }
    }
}
