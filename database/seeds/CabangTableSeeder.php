<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CabangTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      DB::table('cabang')->insert([
        [
          'id_cabang' => 1,
          'nama_cabang' => 'Pusat',
          'ip_server' => 'lapan.go.id',
          'longitude' => '107.591779',
          'latitude' => '-6.893376',
        ],
        [
          'id_cabang' => 2,
          'nama_cabang' => 'Pontianak',
          'ip_server' => '10.16.150.1',
          'longitude' => '109.366238',
          'latitude' => '-0.003658',
        ],
        [
          'id_cabang' => 3,
          'nama_cabang' => 'Biak',
          'ip_server' => '10.18.170.1',
          'longitude' => '136.10077',
          'latitude' => '-1.174',
        ],
        [
          'id_cabang' => 4,
          'nama_cabang' => 'Garut',
          'ip_server' => '10.16.110.1',
          'longitude' => '107.6921543',
          'latitude' => '-7.650007',
        ],
        [
          'id_cabang' => 5,
          'nama_cabang' => 'Tanjung Sari',
          'ip_server' => '10.16.100.1',
          'longitude' => '107.8372133',
          'latitude' => '-6.9130788',
        ],
        [
          'id_cabang' => 6,
          'nama_cabang' => 'Manado',
          'ip_server' => '10.16.180.1',
          'longitude' => '124.8272348',
          'latitude' => '1.4554793',
        ],
        [
          'id_cabang' => 7,
          'nama_cabang' => 'Kupang',
          'ip_server' => '10.16.190.1',
          'longitude' => '123.6589219',
          'latitude' => '-10.1544464',
        ],
        [
          'id_cabang' => 8,
          'nama_cabang' => 'Agam',
          'ip_server' => '10.16.140.1',
          'longitude' => '100.3200362',
          'latitude' => '-0.2044474',
        ],
        [
          'id_cabang' => 9,
          'nama_cabang' => 'Pasuruan',
          'ip_server' => '10.16.130.1',
          'longitude' => '112.6758962',
          'latitude' => '-7.567506',
        ],
        [
          'id_cabang' => 10,
          'nama_cabang' => 'Yogyakarta',
          'ip_server' => '10.16.151.1',
          'longitude' => '112.6758962',
          'latitude' => '-7.567506',
        ],
      ]);
    }
}
