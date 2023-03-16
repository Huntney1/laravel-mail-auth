<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     ** Eseguire i Seed del database
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i<10; $i++) {

            $newProject = new Project();
            $newProject->title = $faker->sentence(3);
            $newProject->description = $faker->text();
            $newProject->slug = Str::slug($newProject->title, '-');
            /* $newProject->published = $faker->dateTimeThisYear()->format('Y-m-d H:i:s'); */
            $newProject->cover_image = $faker->imageUrl(600, 300, 'projects', true, 'dogs', 'jpg');
            $newProject->save();
        }
    }
}
