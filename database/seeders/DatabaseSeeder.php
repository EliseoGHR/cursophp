<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Asegúrate de importar DB
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('docente')->insert([
            'nombre' => 'eliseo',
            'apellido' => 'serrano',
            'email' => 'eliseo@gmail.com',
            'password' => Hash::make('12345'),
        ]);
    }
}
