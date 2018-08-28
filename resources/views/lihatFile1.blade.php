<?php session()->put('flag', 2); ?>
@extends('layouts.PenelitiPartial.master')

@section('content')
<div class="row">
  <div class="col-xs-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Daftar Fail</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th style="width: 1%; text-align:center">Nomor</th>
            <th style="width: 5%; text-align:center"> Lokasi Pengamatan </th>
            <th style="width: 5%; text-align:center"> Nama Alat </th>
            <th style="width: 5%; text-align:center"> Nama Fail </th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          // $file = Session::get('file');
          foreach($file as $filee){
          ?>
              <tr>
                <?php
                $nama_cabang = App\Cabang::where('id_cabang', $filee->id_cabang)->value('nama_cabang');
                $nama_alat = App\Alat::where('id_alat', $filee->id_alat)->value('nama_alat');
                ?>
                  <td style="text-align:center;">{{ $no }}</td>
                  <td style="text-align:center;">{{ $nama_cabang }}</td>
                  <td style="text-align:center;">{{ $nama_alat }}</td>
                  <td style="text-align:center;">{{ $filee->nama_file }}</td>
                <?php
                $no++;
                ?>
             </tr>
      <?php
        }
      ?>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
    </div>
    </div>
@endsection
