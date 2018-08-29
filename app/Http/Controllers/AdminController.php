<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Userinfo;
use Illuminate\Support\Facades\Hash;
use App\Notifications\SendPassword;
use Session;
use App\sidebar;
use App\Cabang;
use App\File;
use App\Alat;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\InputStream;
use Carbon\Carbon;
use PDF;
use Mail;

session()->regenerate();
error_reporting(0);

class AdminController extends PenelitiController
{
    public function tambahAnggota()
    {
      // $side   = sidebar::orderBy('nama_cabang')->get();
      return view('/tambahStaff');
    }

    public function daftarAnggota()
    {
        $readUser = User::orderBy('id')->get();
        // $side   = sidebar::orderBy('id_cabang')->get();
        return view('/lihatStaff', compact('readUser'));
    }

    public function createAnggota(Request $request)
    {
      $pswd = Session::get('password');
      $this->validate($request, array(
              'name'          => 'required|max:100',
              'email'         => 'required|unique:users,email,',
              'identitas'     => 'required',
              'jabatan'        => 'required',
          ));
      $user   = User::create([
              'name'           => $request->input('name'),
              'email'          => $request->input('email'),
              'password'       => Hash::make($pswd),
              'identitas'      => $request->input('identitas'),
              'isAdmin'        => $request->input('jabatan'),
          ]);
      $info = Userinfo::latest()->first($info);
      session()->put('nama', $request->input('name'));
      session()->put('password', $pswd);
      $info->notify(new SendPassword());

      session()->flash('success', 'Anggota Berhasil Ditambahkan!');
      return redirect()->back();
    }

    public function hapusAnggota($id)
    {
        $user   = User::find($id);
        $user->delete();
        session()->flash('deleteNotif', 'Anggota Berhasil Dihapus!');
        return redirect()->route('lihatStaff.readAll');
    }

    public function lihatChart($id)
    {
        $side = sidebar::orderBy('id_cabang')->get();
        $file = File::orderBy('id_file')->get();
        $alat = Alat::orderBy('id_alat')->get();
        session()->put('file', $file);
        session()->put('alat', $alat);
        session()->put('id', $id);
        return view('Agam', compact('side'));
    }

    public function tambahCabang()
    {
      return view('tambahCabang');
    }

    public function daftarCabang()
    {
      $cabang = Cabang::orderBy('id_cabang')->get();
      return view('DaftarCabang', compact('cabang'));
    }

    public function hapusCabang($id)
    {
        $cabang   = Cabang::where('id_cabang', $id);
        $cabang->delete();
        session()->flash('deleteNotif', 'Lokasi Pengamatan Berhasil Dihapus!');
        return redirect()->route('DaftarCabang');
    }

    public function createCabang(Request $request)
    {
      $this->validate($request, array(
              'nama_cabang'    => 'required|max:100',
              'ip_server'      => 'required',
          ));

          $address = $request->input('nama_cabang');

          // Get JSON results from this request
          $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');
          $geo = json_decode($geo, true); // Convert the JSON to an array

          if (isset($geo['status']) && ($geo['status'] == 'OK')) {
            $latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
            $longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
          }

      $user   = Cabang::create([
              'nama_cabang'   => $request->input('nama_cabang'),
              'ip_server'     => $request->input('ip_server'),
              'longitude'     => $longitude,
              'latitude'      => $latitude,
          ]);

      session()->flash('success', 'Cabang Berhasil Ditambahkan');
      return redirect()->back();
    }

    public function profilAdmin()
    {
      $side   = sidebar::orderBy('id_cabang')->get();
      return view('profil', compact('side'));
    }

    public function daftarAlat()
    {
      $alat = Alat::orderBy('id_alat')->get();
      $cabang = Cabang::orderBy('id_cabang')->get();
      return view('DaftarAlat', compact('alat'), compact('cabang'));
    }

    public function hapusAlat($id)
    {
        $alat   = Alat::where('id_alat', $id);
        $alat->delete();
        session()->flash('deleteNotif', 'Alat Berhasil Dihapus!');
        return redirect()->route('DaftarAlat');
    }

    public function tambahAlat()
    {
      return view('tambahAlat');
    }

    public function createAlat(Request $request)
    {
      $this->validate($request, array(
              'nama_alat'           => 'required|max:100',
              'identitas_alat'      => 'required',
          ));

      $user   = Alat::create([
              'nama_alat'          => $request->input('nama_alat'),
              'identitas_alat'     => $request->input('identitas_alat'),
          ]);

      session()->flash('success', 'Alat Berhasil Ditambahkan');
      return redirect()->back();
    }

    public function Laporan()
    {
      return view('laporan');
    }

    public function lihatLaporan($lihat)
    {
      $penerima = Userinfo::orderBy('id')->get();
      $hari = Carbon::now()->day;
      $bulan = Carbon::now()->month;
      $tahun = Carbon::now()->year;

      if($bulan == 1) {
        $bulan = 'Januari';
        $laporan = 'Desember';
      }
      else if($bulan == 2) {
        $bulan = 'Februari';
        $laporan = 'Januari';
      }
      else if($bulan == 3) {
        $bulan = 'Maret';
        $laporan = 'Februari';
      }
      else if($bulan == 4) {
        $bulan = 'April';
        $laporan = 'Maret';
      }
      else if($bulan == 5) {
        $bulan = 'Mei';
        $laporan = 'April';
      }
      else if($bulan == 6) {
        $bulan = 'Juni';
        $laporan = 'Mei';
      }
      else if($bulan == 7) {
        $bulan = 'Juli';
        $laporan = 'Juni';
      }
      else if($bulan == 8) {
        $bulan = 'Agustus';
        $laporan = 'Juli';
      }
      else if($bulan == 9) {
        $bulan = 'September';
        $laporan = 'Agustus';
      }
      else if($bulan == 10) {
        $bulan = 'Oktober';
        $laporan = 'September';
      }
      else if($bulan == 11) {
        $bulan = 'November';
        $laporan = 'Oktober';
      }
      else if($bulan == 12) {
        $bulan = 'Desember';
        $laporan = 'November';
      }

      $cabang = Cabang::orderBy('nama_cabang')->get();
      $alat = Alat::orderBy('id_alat')->get();
      $file = File::orderBy('id_file')->get();

      session()->put('laporan', $laporan);
      session()->put('cabang', $cabang);
      session()->put('alat', $alat);
      session()->put('file', $file);
      session()->put('tahun', $tahun);
      session()->put('bulan', $laporan);

      $tanggal = $hari . ' ' . $bulan . ' ' . $tahun;

      if((integer)$lihat==0) {
        foreach($penerima as $penerimas) {
          if($penerimas->isAdmin == 2) {
            Mail::send('mail', ['name',$penerimas->name], function($message) use($penerimas){
              $bulan = Carbon::now()->month;
              $tahun = Carbon::now()->year;

              if($bulan == 1) {
                $bulan = 'Januari';
                $laporan = 'Desember';
              }
              else if($bulan == 2) {
                $bulan = 'Februari';
                $laporan = 'Januari';
              }
              else if($bulan == 3) {
                $bulan = 'Maret';
                $laporan = 'Februari';
              }
              else if($bulan == 4) {
                $bulan = 'April';
                $laporan = 'Maret';
              }
              else if($bulan == 5) {
                $bulan = 'Mei';
                $laporan = 'April';
              }
              else if($bulan == 6) {
                $bulan = 'Juni';
                $laporan = 'Mei';
              }
              else if($bulan == 7) {
                $bulan = 'Juli';
                $laporan = 'Juni';
              }
              else if($bulan == 8) {
                $bulan = 'Agustus';
                $laporan = 'Juli';
              }
              else if($bulan == 9) {
                $bulan = 'September';
                $laporan = 'Agustus';
              }
              else if($bulan == 10) {
                $bulan = 'Oktober';
                $laporan = 'September';
              }
              else if($bulan == 11) {
                $bulan = 'November';
                $laporan = 'Oktober';
              }
              else if($bulan == 12) {
                $bulan = 'Desember';
                $laporan = 'November';
              }

                $message->to($penerimas->email,$penerimas->name)->subject('Laporan Monitoring Bulan ' . $laporan);
                $message->from('siapLapan@lapan.com','Sistem siapLapan');
                $pdf = PDF::loadView('cuba', compact('penerimas'), compact('tanggal'));
                $message->attachData($pdf->output(), 'Laporan Monitoring Data Bulan '. $laporan . ' ' . $tahun .'.pdf');
            });
          }
        }
        session()->flash('success', 'Fail Sukses Dikirim!');
        return redirect()->back();
      }

      else {
        $pdf = PDF::loadView('cuba', compact('penerimas'), compact('tanggal'));
        return $pdf->stream('Laporan Monitoring Data Bulan '. $laporan . ' ' . $tahun .'.pdf');
      }
    // echo 'Email was sent!';
    }

    // public function lihatFile()
    // {
    //   $file = File::orderBy('id_file')->get();
    //   $cabang = Cabang::orderBy('id_cabang')->get();
    //   $alat = Alat::orderBy('id_alat')->get();
    //   return view('lihatFile', compact('file'), compact('cabang'), compact('alat'));
    // }
}
