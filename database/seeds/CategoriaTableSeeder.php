<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class CategoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 8; $i++) {
            $title = $faker->sentence;
            $body = $faker->text(250);
            $slug = Str::slug($title);
            $color = "#" . rand(0, 559900);
            \DB::table('categorias')->insert(array(
                'nombre' => $title,
                'slug' => $slug,
                'descripcion' => $body,
                'color' => $color

            ));

        }
    }

}
