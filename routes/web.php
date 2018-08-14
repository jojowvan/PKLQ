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

//Route::get('/ea', function(){
  //run cmd
  //$process = new Process('python as.py');
  //$process->run();
  //sampe sini
//});

Route::prefix('admin')->group(function(){
  Route::get('/tambahAnggota', 'AdminController@view')->name('tambahStaff.view');
  Route::post('/tambahAnggota', 'AdminController@create')->name('tambahStaff.create');

  Route::get('/lihatAnggota', 'AdminController@readAll')->name('lihatStaff.readAll');
  Route::delete('/lihatAnggota/{id}/delete', 'AdminController@destroy')->name('lihatStaff.destroy');

  Route::get('/profil', 'AdminController@profilAdmin')->name('profilAdmin');
  Route::post('/profil', 'UserController@gantiPassword')->name('ganti.password');

  Route::get('/lihatCabang/{id_cabang}', 'AdminController@viewCabang')->name('lihat.agam');

  Route::get('/tambahCabang', 'AdminController@tambahCabang')->name('tambahCabang');
  Route::post('/tambahCabang', 'AdminController@createCabang')->name('tambahCabang.create');

  Route::get('/lihatFile', 'AdminController@lihatFile')->name('lihatFile');

  Route::get('/DaftarCabang', 'AdminController@DaftarCabang')->name('DaftarCabang');
  Route::delete('/DaftarCabang/{id}/delete', 'AdminController@HapusCabang')->name('HapusCabang');

  Route::get('/DaftarAlat', 'AdminController@DaftarAlat')->name('DaftarAlat');
  Route::delete('/DaftarAlat/{id}/delete', 'AdminController@HapusAlat')->name('HapusAlat');

  Route::get('/tambahAlat', 'AdminController@tambahAlat')->name('tambahAlat');
  Route::post('/tambahAlat', 'AdminController@createAlat')->name('tambahAlat.create');

  Route::get('/Laporan', 'AdminController@Laporan')->name('laporan');
});

Route::get('/pdf', 'PDFController@getPDF');

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
