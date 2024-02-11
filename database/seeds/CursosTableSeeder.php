<?php

use App\Curso;
use Illuminate\Database\Seeder;

class CursosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        Curso::create([
            'titulo' => $faker->sentence($nbWords = 6, $variableNbWords = true),
            'descripcion' => $faker->text,
            'contenido' => $faker->randomHtml(2,3),
            'lugar' => 'Online',
            'categoria_id' => 1,
            'slug' => $faker->slug(),
            'estado' => 'En curso',
            'unit_price' => 25000,
            'publicado' => true
        ]);

        Curso::create([
            'titulo' => $faker->sentence($nbWords = 6, $variableNbWords = true),
            'descripcion' => $faker->text,
            'contenido' => $faker->randomHtml(2,3),
            'lugar' => 'Online',
            'categoria_id' => 2,
            'slug' => $faker->slug(),
            'estado' => null,
            'unit_price' => null,
            'publicado' => true
        ]);
    }
}
