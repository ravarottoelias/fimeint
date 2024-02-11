<?php

use App\Curso;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Faker\Factory::create();

         DB::table('users')->insert([
        	'id' => 1,
	    	'name' =>  'Admin R.',
    		'email' =>  'administrator@gmail.com.ar',
            'password'  =>  Hash::make(env('DEFAULT_ADMIN_PASS', 'admin')),
	    	'documento_tipo' =>  'DNI',
	    	'documento_nro' =>  '35689899',
	    	'profesion' =>  'Developer',
	    	'pais' =>  null,
	    	'provincia' =>  null,
	    	'codigo_tel_pais' =>  null,
	    	'telefono' =>  null,
	    	'remember_token' =>  'KiduSur65M8XhwsHQEBqcaeONz6zKpt5hc9T1rxTaIel0D37yaFCOGgln0wC',
	    	'created_at' =>  '2020-06-19 09:27:51',
	    	'updated_at' => '2020-06-19 09:27:51'
        ]);

		DB::table('roles')->insert([
			'role' =>  'admin',
			'display_name' =>  'Administrador',
			'created_at' =>  '2020-06-19 09:27:51',
			'updated_at' => '2020-06-19 09:27:51'
		]);
		DB::table('roles')->insert([
			'role' =>  'alumno',
			'display_name' =>  'Alumno',
			'created_at' =>  '2020-06-19 09:27:51',
			'updated_at' => '2020-06-19 09:27:51'
		]);


        DB::table('assigned_roles')->insert([
	    	'user_id' =>  1,
    		'role_id' =>  1,
	    	'created_at' =>  '2020-06-19 09:27:51',
	    	'updated_at' => '2020-06-19 09:27:51'
        ]);

		DB::table('categorias')->insert([
			'nombre' => 'Oferta Académica',
			'slug' => 'oferta-academica',
			'created_at' => '2020-06-19 09:27:51',
			'updated_at' => '2020-06-19 09:27:51'
		]);
		DB::table('categorias')->insert([
			'nombre' => 'Noticias y Novedades',
			'slug' => 'noticias-y-novedades',
			'created_at' => '2020-06-19 09:27:51',
			'updated_at' => '2020-06-19 09:27:51'
		]);
		DB::table('categorias')->insert([
			'nombre' => 'RSE',
			'slug' => 'rse',
			'created_at' => '2020-06-19 09:27:51',
			'updated_at' => '2020-06-19 09:27:51'
		]);

		Curso::create([
            'titulo' => $faker->sentence($nbWords = 6, $variableNbWords = true),
            'descripcion' => $faker->text,
            'contenido' => $faker->randomHtml(2,3),
            'lugar' => 'Online',
            'categoria_id' => 1,
            'slug' => $faker->slug(),
            'estado' => 'En curso',
            'publicado' => true
        ]);

    }
}
