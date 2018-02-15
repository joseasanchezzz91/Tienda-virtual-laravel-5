<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class ProductoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 20; $i++) {
            $title = $faker->sentence;
            $body = $faker->text(250);
            $slug = Str::slug($title);

            $precio = rand(100, 5000);
            $categoria = rand(1, 8);
            \DB::table('productos')->insert(array(
                'nombre' => $title,
                'slug' => $slug,
                'descripcion' => $body,
                'extracto' => 'loremLorem Ipsum es e texto. Loremndar 0',
                'precio' => $precio,
                'imagen' => 'https://www.nestle-fitness.com/sites/default/files/styles/product_list_image/public/boximages/fitness-fruits-690g-co-1468870204.jpg?itok=CQdy_qH-',
                'visible' => 1,
                'categoria_id' => $categoria

            ));


        }
    }

}
