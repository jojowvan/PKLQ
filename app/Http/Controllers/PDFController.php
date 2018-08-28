<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Userinfo;
use App\Cabang;
use App\Alat;
use App\File;
use Carbon\Carbon;
use PDF;
use Mail;
use Session;

class PDFController extends Controller
{
  public function getPDF() {
    //$Users = Userinfo::orderBy('id')->get();
    //$pdf = PDF::loadView('anggota', compact('Users'));
    //return $pdf->stream('Laporan Anggota Sistem siapLapan.pdf');

    // $cabang = Cabanginfo::orderBy('id_cabang')->get();
    // $pdf = PDF::loadView('cabang', compact('cabang'));
    // return $pdf->stream('Laporan Cabang Sistem siapLapan.pdf');

    // $alat = Alatinfo::orderBy('id_alat')->get();
    // $pdf = PDF::loadView('alat', compact('alat'));
    // return $pdf->stream('Laporan Alat Sistem siapLapan.pdf');

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

    $tanggal = $hari . ' ' . $bulan . ' ' . $tahun;

    $pdf = PDF::loadView('cuba', compact('penerimas'), compact('tanggal'));
    $lihat=1;
    if($lihat==0) {
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

              // $pdf = PDF::loadView('cuba', compact('penerimas'), compact('tanggal'));
              // return $pdf->stream('Laporan Alat Sistem siapLapan.pdf');
              $message->to($penerimas->email,$penerimas->name)->subject('Laporan Monitoring Bulan ' . $laporan);
              $message->from('siapLapan@lapan.com','Sistem siapLapan');
              $message->attachData($pdf->output(), 'Laporan Monitoring Bulan.pdf');
          });
        }
      }
    }
    else {
      return $pdf->stream('Laporan Alat Sistem siapLapan.pdf');
    }
  // echo 'Email was sent!';
    // return $pdf->stream('Kop Surat siapLapan.pdf');
  }
}
