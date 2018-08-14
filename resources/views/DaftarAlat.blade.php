<?php session()->put('flag', 1); ?>
@extends('templates.admins.master')

@section('content')
  <div class="col-md-12 col-sm-12 col-xs-12">
    @if (session()->has('deleteNotif'))
      <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong> {{session()->get('deleteNotif')}} </strong>
      </div>
    @endif

    @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong> {{session()->get('success')}} </strong>
      </div>
    @endif

    <div class="x_panel">
      <div class="x_title">
        <h2>Daftar Cabang</h2>
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
              <th style="width: 1%">Actions</th>
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
              <td>
                <?php
                  if($alats->id_alat != Auth::id()) {
                ?>

                <form action="{{ route('HapusAlat', $alats->id_alat) }}" method="post" id="deleteButton">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <button type="submit"  class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>Delete</button>

                    <script>
                      document.getElementById('deleteButton').onclick = function(event){
                        event.preventDefault();
                      	swal({
                      		title: "Apakah anda yakin ingin menghapus?",
                      		text: "Anda tidak dapat mengembalikan kembali.",
                      		type: "warning",
                      		showCancelButton: true,
                      		confirmButtonColor: '#DD6B55',
                      		confirmButtonText: 'Ya',
                      		closeOnConfirm: false,
                      		//closeOnCancel: false
                      	},
                      	function(){
                          // swal("Terhapus", "Akun telah terhapus!", "Sukses");
                          document.getElementById("deleteButton").submit();
                      	});
                      };
                    </script>

                  </form>

                <?php
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
