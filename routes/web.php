<?php

use App\Http\Controllers\Controller;
use App\Notifications\SendPassword;
use App\Userinfo;
use App\Cabang;
use App\Alat;
use App\File;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use vendor\laravel\framework\src\Illuminate\Contracts\Support\Htmlable;
use Carbon\Carbon;
session()->regenerate();
error_reporting(0);

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('admin.dashboard');

// Route::get('/home/DaftarAlat', 'UserController@daftarAlat')->name('daftarAlat');
//Route::get('/ea', function(){
  //run cmd
  //$process = new Process('python as.py');
  //$process->run();
  //sampe sini
//});

Route::prefix('admin')->group(function(){
  //Keanggotaan
  Route::get('/tambahAnggota', 'AdminController@tambahAnggota')->name('tambahStaff.view');
  Route::get('/lihatAnggota', 'AdminController@daftarAnggota')->name('lihatStaff.readAll');
  Route::post('/tambahAnggota', 'AdminController@createAnggota')->name('tambahStaff.create');
  Route::delete('/lihatAnggota/{id}/delete', 'AdminController@hapusAnggota')->name('lihatStaff.destroy');

  //Ganti Password
  Route::get('/profil', 'AdminController@profilAdmin')->name('profilAdmin');
  Route::post('/profil', 'AdminController@gantiPassword')->name('ganti.password');

  //Monitor Lokasi
  Route::get('/lihatCabang/{id_cabang}', 'AdminController@lihatChart')->name('lihat.agam');

  //Lokasi Pengamatan
  Route::post('/tambahCabang', 'AdminController@createCabang')->name('tambahCabang.create');
  Route::get('/tambahCabang', 'AdminController@tambahCabang')->name('tambahCabang');
  Route::get('/DaftarCabang', 'AdminController@daftarCabang')->name('DaftarCabang');
  Route::delete('/DaftarCabang/{id}/delete', 'AdminController@hapusCabang')->name('HapusCabang');

  //Daftar Alat
  Route::get('/DaftarAlat', 'AdminController@daftarAlat')->name('DaftarAlat');
  Route::delete('/DaftarAlat/{id}/delete', 'AdminController@hapusAlat')->name('HapusAlat');
  Route::get('/tambahAlat', 'AdminController@tambahAlat')->name('tambahAlat');
  Route::post('/tambahAlat', 'AdminController@createAlat')->name('tambahAlat.create');

  //Laporan
  Route::get('/Laporan', 'AdminController@Laporan')->name('laporan');
  Route::get('/lihatLaporan/{id}', 'AdminController@lihatLaporan')->name('lihatLaporan');

  // Route::get('/lihatFile', 'AdminController@lihatFile')->name('lihatFile');
});

Route::prefix('peneliti')->group(function(){
  //Monitor Lokasi
  Route::get('/home/{id_cabang}', 'PenelitiController@lihatChartPeneliti')->name('kapuslihat.agam');

  //Daftar Alat
  Route::get('/daftarAlatPeneliti', 'PenelitiController@daftarAlatPeneliti')->name('daftarAlat2');

  //Daftar Fail
  Route::get('/lihatFailPeneliti', 'PenelitiController@lihatFilePeneliti')->name('lihatFile1');

  //Profil
  Route::get('/profilPeneliti', 'PenelitiController@profilPeneliti')->name('profilPeneliti');
  Route::post('/profilPeneliti', 'PenelitiController@gantiPassword')->name('ganti.password');
});

Route::prefix('kabid')->group(function(){
  //Monitor Lokasi
  Route::get('/home/{id_cabang}', 'KapusController@lihatChartKabid')->name('kapuslihat.agam');

  //Profil
  Route::get('/profilKabid', 'KapusController@profilKabid')->name('profil1');
  Route::post('/profilKabid', 'KapusController@gantiPassword')->name('ganti.password');

  //Daftar Alat
  Route::get('/daftarAlatKabid', 'KapusController@daftarAlatKabid')->name('daftarAlat1');
});

// Route::get('/wow', function(){
//   $process = new Process('python ../routes/cabang.py');
//   $process->run();
//
//   $output = $process->getOutput();
//   $myarray = array();
//   $myarray = preg_split('/\r\n/', $output);
//   unset($myarray[2]);
//   dd($myarray);
// });

Route::get('/ea', function(){
$mysqli = new mysqli("localhost", "root", "", "siaplapan");

// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}

  $process = new Process('python ../routes/data.py');
  $process->run();

  if (!$process->isSuccessful()) {
    throw new ProcessFailedException($process);
	}

  $output = $process->getOutput();
  $myarray = array();
  $output = str_replace('[', '', $output);
  $output = str_replace('"', '', $output);
  $output = str_replace(']]', ']', $output);
  $output = str_replace('],', ']', $output);
  $myarray = explode(']', $output);

  $daerah = explode(', ', $myarray[0]);
  array_splice($myarray,0,1);

  $fail = array();

  for($i=0;$i<count($myarray);$i++) {
	   $fail[$i] = explode(', ', $myarray[$i]);
	}

  for($i=0;$i<count($myarray);$i++) {
	   $fail[$i][0] = substr($fail[$i][0], 1);
  }

  $identitas = Alat::orderBy('id_alat')->pluck('identitas_alat');
  $alat = Alat::orderBy('id_alat')->pluck('id_alat');

  for($i=0;$i<count($daerah);$i++) {
    $id_daerah = Cabang::where('nama_cabang', $daerah[$i])->value('id_cabang');
  	for($j=0;$j<count($fail[$i]);$j++) {
      for($k=0;$k<count($identitas);$k++) {
        $id_alat = 99; //nanti apus
        if(strpos(strtolower($fail[$i][$j]), strtolower($identitas[$k])) !== false) {
          $id_alat = $alat[$k];
          break;
        }
  	  }

  		$str = $fail[$i][$j];
      $current_time = Carbon::now();
      $current_time = $current_time->format('Y-m-d');

      $user   = File::create([
              'id_cabang'       => $id_daerah,
              'id_alat'         => $id_alat,
              'nama_file'       => $str,
              'created_at'      => $current_time,
              'updated_at'      => $current_time,
          ]);

  		// $sql = "INSERT INTO file (id_cabang, id_alat, nama_file) VALUES ('$id_daerah', '$id_alat', '$str')";
  		// $mysqli->query($sql) === true;
  	}
  }

// if($mysqli->query($sql) === true) {
//     echo "Records inserted successfully.";
// }
//
// else {
//     echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
// }

$mysqli->close();
});
