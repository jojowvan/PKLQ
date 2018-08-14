
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
              <th style="width: 1%" >Nomor</th>
              <th style="width: 5%" > Lokasi Cabang </th>
              <th style="width: 5%"> Nama Alat </th>
              <th style="width: 5%"> Nama File </th>
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
                      <td>{{ $no }}</td>
                      <td>{{ $nama_cabang }}</td>
                      <td>{{ $nama_alat }}</td>
                      <td>{{ $filee->nama_file }}</td>
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
    </div>
  </div>
@endsection
