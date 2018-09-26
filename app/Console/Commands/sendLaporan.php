<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Cabang;
use App\File;
use App\Alat;
use App\User;
use App\Userinfo;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\InputStream;
use Carbon\Carbon;
use PDF;
use Mail;
use DB;

class sendLaporan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:laporan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengirim Laporan Bulanan';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
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

      // if((integer)$lihat==0) {
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
      // }
    }
}
