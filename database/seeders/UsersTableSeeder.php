<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
      \DB::table('users')->insert([
        [
          'name' => 'Charlotte',
          'email' => 'Charlotte@test.nl',
          'password' => bcrypt('qwerty'),
        ],
      ]);
    }
}
