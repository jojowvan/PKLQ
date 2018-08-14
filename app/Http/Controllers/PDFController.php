<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Userinfo;
use App\Cabanginfo;
use App\Alatinfo;
use PDF;
use Mail;

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
    foreach($penerima as $penerimas) {
      if($penerimas->isAdmin == 2) {
        Mail::send('mail', ['name',$penerimas->name], function($message) use($penerimas){
          // dd($penerimas->name);
            $pdf = PDF::loadView('cuba');
            $message->to($penerimas->email,$penerimas->name)->subject('Laporan Monitoring Bulan X');
            $message->from('siapLapan@lapan.com','Sistem siapLapan');
            $message->attachData($pdf->output(), 'Laporan Monitoring Bulan.pdf');
        });
      }
    }
  echo 'Email was sent!';
    // return $pdf->stream('Kop Surat siapLapan.pdf');
  }
}
