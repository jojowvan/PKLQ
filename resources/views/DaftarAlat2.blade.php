<?php session()->put('flag', 0); ?>
@extends('layouts.PenelitiPartial.master')

@section('title')
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Daftar Alat</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th style="width: 1%" >Nomor</th>
              <th style="width: 1%"> Nama Alat</th>
              <th>Identitas Alat</th>
              <th>Berada di Cabang</th>
            </tr>
          </thead>
          <tbody>
              <?php $no = 0;?>
                @foreach($alat as $alats)
              <?php $no++ ;?>
            <tr>
              <td>{{ $no }}</td>
              <td>{{ $alats->nama_alat }}</td>
              <td>{{ $alats->identitas_alat }}</td>
              <?php
              $cocok   = App\File::where('id_alat', $alats->id_alat)->pluck('id_cabang');
              $cucok   = array();
              foreach($cocok as $cocoks) {
                array_push($cucok, $cocoks);
              }
              $cucok = array_unique($cucok);
              // dd($cucok);
              ?>
              <td>
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
    </div>
  </div>
@endsection
