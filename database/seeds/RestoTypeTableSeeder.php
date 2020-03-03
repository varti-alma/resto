<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestoTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('resto_types')->insert(['description' => 'Familiar', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('resto_types')->insert(['description' => 'Lujo', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('resto_types')->insert(['description' => 'Cadena', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('resto_types')->insert(['description' => 'Hotel', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('resto_types')->insert(['description' => 'Sushi', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('resto_types')->insert(['description' => 'Comida chilena', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('resto_types')->insert(['description' => 'Pizza', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('resto_types')->insert(['description' => 'Hamburguesa', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('resto_types')->insert(['description' => 'China', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('resto_types')->insert(['description' => 'Pasta', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('resto_types')->insert(['description' => 'Árabe', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('resto_types')->insert(['description' => 'Peruana', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('resto_types')->insert(['description' => 'Tailandesa', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('resto_types')->insert(['description' => 'Francesa', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('resto_types')->insert(['description' => 'Española', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('resto_types')->insert(['description' => 'Temática', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('resto_types')->insert(['description' => 'Pub/Bar', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('resto_types')->insert(['description' => 'Argentina', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('resto_types')->insert(['description' => 'Parrillada', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('resto_types')->insert(['description' => 'Picada', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('resto_types')->insert(['description' => 'Venezolana', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('resto_types')->insert(['description' => 'Colombiana', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('resto_types')->insert(['description' => 'Mexicana', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('resto_types')->insert(['description' => 'Sanguchería', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
    }
}
