<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExperienceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('experiences')->insert(['description' => 'Mesero', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('experiences')->insert(['description' => 'Lavacopa', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('experiences')->insert(['description' => 'Cocinero', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('experiences')->insert(['description' => 'Chef', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('experiences')->insert(['description' => 'Ayudante de cocina', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('experiences')->insert(['description' => 'Bartender', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('experiences')->insert(['description' => 'Cajero', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('experiences')->insert(['description' => 'Anfitrion', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('experiences')->insert(['description' => 'Jefe de local', 'type' => true, 'created_at' => date("Y-m-d H:i:s")]);
    }
}
