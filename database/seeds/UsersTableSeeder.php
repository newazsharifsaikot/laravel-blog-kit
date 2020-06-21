<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id' => 1,
            'name' => 'Newaz Sharif',
            'username' => 'saikot',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
        ]);

        DB::table('users')->insert([
            'role_id' => 2,
            'name' => 'Raju Ahmed',
            'username' => 'raju',
            'email' => 'author@gmail.com',
            'password' => bcrypt('author'),
        ]);
    }
}
