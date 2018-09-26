<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Alat;
use App\File;
use App\Cabang;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Carbon\Carbon;
session()->regenerate();
error_reporting(0);

class updateData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Data';

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
        }
        // $mysqli->close();
    }
    }
}
