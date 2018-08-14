<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlatTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      DB::table('alat')->insert([
        [
          'id_alat' => 1,
          'nama_alat' => 'airglow',
          'identitas_alat' => 'cd1',
        ],
        [
          'id_alat' => 2,
          'nama_alat' => 'geomagnet',
          'identitas_alat' => 'rs',
        ],
        [
          'id_alat' => 3,
          'nama_alat' => 'ionosonda',
          'identitas_alat' => '.png',
        ],
        [
          'id_alat' => 4,
          'nama_alat' => 'scin1',
          'identitas_alat' => 'scin1',
        ],
        [
          'id_alat' => 5,
          'nama_alat' => 'scin3',
          'identitas_alat' => 'scin3',
        ],
        [
          'id_alat' => 6,
          'nama_alat' => 'beacon',
          'identitas_alat' => '.zip',
        ],
        [
          'id_alat' => 7,
          'nama_alat' => 'cadi',
          'identitas_alat' => '.md4',
        ],
        [
          'id_alat' => 8,
          'nama_alat' => 'gistm',
          'identitas_alat' => 'redobs',
        ],
        [
          'id_alat' => 9,
          'nama_alat' => 'mwr',
          'identitas_alat' => 'mp',
        ],
        [
          'id_alat' => 10,
          'nama_alat' => 'meteo',
          'identitas_alat' => '.csv',
        ],
        [
          'id_alat' => 11,
          'nama_alat' => 'callisto',
          'identitas_alat' => '.fit',
        ],
        [
          'id_alat' => 12,
          'nama_alat' => 'celestron',
          'identitas_alat' => '.jpg',
        ],
        [
          'id_alat' => 13,
          'nama_alat' => 'sn-4000',
          'identitas_alat' => '.bin',
        ],
        [
          'id_alat' => 14,
          'nama_alat' => 'maws',
          'identitas_alat' => '.dat',
        ],
      ]);
    }
}
