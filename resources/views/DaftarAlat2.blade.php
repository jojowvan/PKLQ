<?php session()->put('flag', 1); ?>
@extends('layouts.PenelitiPartial.master')

@section('content')
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Daftar Alat</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="width: 20%; text-align:center;" >Nomor</th>
                <th style="width: 20%; text-align:center;"> Nama Alat</th>
                <!-- <th>Identitas Alat</th> -->
                <th style="text-align:center;">Lokasi Pengamatan</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 0;?>
                @foreach($alat as $alats)
              <?php $no++ ;?>
            <tr>
              <td style="text-align:center;">{{ $no }}</td>
              <td style="text-align:center;">{{ $alats->nama_alat }}</td>
              <!-- <td>{{ $alats->identitas_alat }}</td> -->
              <?php
              $cocok   = App\File::where('id_alat', $alats->id_alat)->pluck('id_cabang');
              $cucok   = array();
              foreach($cocok as $cocoks) {
                array_push($cucok, $cocoks);
              }
              $cucok = array_unique($cucok);
              // dd($cucok);
              ?>
              <td style="text-align:center;">
              <?php
              $cucok = array_values($cucok);
              if(count($cucok) == 0) {
                echo('Saat ini belum tersedia di cabang manapun');
              }
              for($i=0;$i<count($cucok);$i++) {
                $nama_cabang = App\Cabang::where('id_cabang', $cucok[$i])->value('nama_cabang');
                echo($nama_cabang);
                if(count($cucok) > 2) {
                  if($i+2 < count($cucok)) {
                    echo(', ');
                  }
                }
                else {
                  if($i+1 < count($cucok)) {
                    echo(' dan ');
                  }
                }
              }
              ?>
              </td>
            </tr>

            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>
@endsection
