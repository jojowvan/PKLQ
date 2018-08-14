<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

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
          'name'      => 'Admin',
          'email'     => 'admin@admin.com',
          'password'  => Hash::make('admins'),
          'identitas' => '14045',
          'isAdmin'   => 1,
          'remember_token' => str_random(10),
      ]);
    }
}
