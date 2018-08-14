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
              <th style="width: 1%"> Nama Cabang</th>
              <th>IP Server</th>
              <th style="width: 1%">Actions</th>
            </tr>
          </thead>
          <tbody>
              <?php $no = 0;?>
                @foreach($cabang as $cabangs)
              <?php $no++ ;?>
            <tr>
              <td>{{ $no }}</td>
              <td>{{ $cabangs->nama_cabang }}</td>
              <td>{{ $cabangs->ip_server }}</td>
              <td>
                <?php
                  if($cabangs->id_cabang != Auth::id()) {
                ?>

                <form action="{{ route('HapusCabang', $cabangs->id_cabang) }}" method="post" id="deleteButton">
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
