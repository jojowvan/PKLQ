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
      [
          'name'      => 'Admin',
          'email'     => 'admin@lapan.com',
          'password'  => Hash::make('admins'),
          'identitas' => '1000',
          'isAdmin'   => 1,
          'remember_token' => str_random(10),
      ],
      [
          'name'      => 'Peneliti',
          'email'     => 'peneliti@lapan.com',
          'password'  => Hash::make('penelitis'),
          'identitas' => '1001',
          'isAdmin'   => 0,
          'remember_token' => str_random(10),
      ],
      [
          'name'      => 'Kepala Bidang',
          'email'     => 'kabid@lapan.com',
          'password'  => Hash::make('kapuss'),
          'identitas' => '1002',
          'isAdmin'   => 2,
          'remember_token' => str_random(10),
      ],
    ]);
    }
}
