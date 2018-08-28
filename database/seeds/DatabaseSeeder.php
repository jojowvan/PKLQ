<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(FileTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CabangTableSeeder::class);
        $this->call(AlatTableSeeder::class);
    }
}
