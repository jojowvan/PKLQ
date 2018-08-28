<?php session()->put('flag', 10); ?>
@extends('templates.admins.master')

@section('content')
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Daftar Laporan</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th style="width: 1%">Nomor</th>
              <th style="width: 5%"> Judul Laporan </th>
              <!-- <th style="width: 5%"> Dikirim Kepada </th> -->
              <th style="width: 5%"> Aksi </th>
            </tr>
          </thead>

          <?php
          use Carbon\Carbon;
          $start = 7;
          $start_tahun = 2018;
          $inc = 0;
          $bulan = (integer)Carbon::now()->month;
          $tahun = (integer)Carbon::now()->year;
          // $bulan = 3;
          // $tahun = 2019;
          $extra = ($tahun - $start_tahun) * 12;
          $banyak = $bulan + $extra - $start;
          $nomor = 1;
          ?>

          <tbody>
          <?php
          for($i=0;$i<$banyak;$i++) {
            if($start==1) {
              $start1 = 'Januari';
            }
            else if($start==2) {
              $start1 = 'Februari';
            }
            else if($start==3) {
              $start1 = 'Maret';
            }
            else if($start==4) {
              $start1 = 'April';
            }
            else if($start==5) {
              $start1 = 'Mei';
            }
            else if($start==6) {
              $start1 = 'Juni';
            }
            else if($start==7) {
              $start1 = 'Juli';
            }
            else if($start==8) {
              $start1 = 'Agustus';
            }
            else if($start==9) {
              $start1 = 'September';
            }
            else if($start==10) {
              $start1 = 'Oktober';
            }
            else if($start==11) {
              $start1 = 'November';
            }
            else if($start==12) {
              $start1 = 'Desember';
            }
          ?>
            <tr>
              <td> {{$nomor}} </td>
              <td> Laporan Monitoring Data {{$start1}} {{$start_tahun + $inc}}</td>
              <!-- <td> Test </td> -->
              <td>
                  <a href="{{route('lihatLaporan', 0)}}" class="btn btn-primary btn-xs"><i class="fa fa-envelope-o"></i> Kirim Laporan</a>
                  <a href="{{route('lihatLaporan', 1)}}" class="btn btn-warning btn-xs"><i class="fa fa-search"></i> Lihat Laporan</a>
              </td>
            </tr>
          <?php
          $start++;
          if($start>12) {
            $start = 1;
            $inc++;
          }
          $nomor++;
          }
          ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
