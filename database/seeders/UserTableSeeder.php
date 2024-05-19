<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'role_id' => '1',
            'name' => 'superadmin',
            'email' => 'superadministrator@app.com',
            'sim' => '1234',
            'phone' => '071231',
            'address' => 'alamat',
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'role_id' => '2',
            'name' => 'user',
            'email' => 'user@app.com',
            'sim' => '4321',
            'phone' => '0812323213',
            'address' => 'alamat',
            'password' => bcrypt('password'),
        ]);
    }
}
