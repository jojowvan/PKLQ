@extends('templates.admins.master')

@section('content')
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Daftar File</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th style="width: 1%">Nomor</th>
              <th style="width: 5%"> Judul Laporan </th>
              <th style="width: 5%"> Dikirim Kepada </th>
              <th style="width: 5%"> Aksi </th>
            </tr>
          </thead>
          <tbody>
              <?php
              $no = 1;
              // $file = Session::get('file');
              // foreach($file as $filee){
            // }
          ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
