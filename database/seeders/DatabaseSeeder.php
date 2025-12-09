<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Container\Attributes\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
          
        ]);
        
        FacadesDB::table('users')->insert([

            [
                'name'=>'admin',
                'email'=>'admin@gmail.com',
                'role'=> 'official',
                'password'=>Hash::make('123'),

                'created_at' => now()->toDateTimeString(),
            ],
        ]);
    }
}