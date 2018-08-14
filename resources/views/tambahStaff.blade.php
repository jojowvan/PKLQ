<?php session()->put('flag', 2); ?>
@extends('templates.admins.master')

@section('stylesheets')
  <link href= "{{ asset('css/parsley.css') }}" rel="stylesheet">
  <link href= "{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="x_panel">
    <div class="x_title">
      <h2>Tambah Anggota</h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <br/>

      {{-- alert --}}
      @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <strong>Errors:</strong>
          <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
          </ul>
        </div>
      @endif

      @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <strong> {{session()->get('success')}} </strong>
        </div>
      @endif
      {{-- end alert --}}

      <form class="form-horizontal form-label-left" action="{{ route('tambahStaff.create') }}" method="post"  enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
          <label class="control-label col-md-2">Foto Anggota
          </label>
          <div class="col-md-4">
            {{--  <input type="file" class="form-control" name="photo" placeholder="Foto Anggota" class="form-control col-md-9 col-xs-12">  --}}
            <input type="file" class="form-control" name="image" >
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-2">Nama Anggota
            <span class="required">*</span>
          </label>
          <div class="col-md-9">
            <input type="text" class="form-control" required="required" name="name" placeholder="Nama Anggota" class="form-control col-md-9 col-xs-12">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-2">Email Anggota
            <span class="required">*</span>
          </label>
          <div class="col-md-9">
            <input type="email" class="form-control" required="required" name="email" placeholder="Email Anggota" class="form-control col-md-9 col-xs-12">
          </div>
        </div>

        <!-- <div class="form-group">
          <label class="control-label col-md-2">Password Anggota
            <span class="required">*</span>
          </label>
          <div class="col-md-9">
            <input type="password" class="form-control" required="required" name="password" placeholder="Password Anggota" class="form-control col-md-9 col-xs-12">
          </div>
        </div> -->

        <div class="form-group">
          <label class="control-label col-md-2">NIK
            <span class="required">*</span>
          </label>
          <div class="col-md-9">
            <input type="text" class="form-control" name="identitas" placeholder="Nomor Identitas Anggota" required="required">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-2">Posisi Keanggotaan
            <span class="required">*</span>
          </label>
          <div class="col-md-9">
              <select class="tags form-control program-multi" tabindex="-1"  name="jabatan" required="required">
                  <option value="1">Admin</option>
                  <option value="2">Kepala Bidang</option>
                  <option value="0">Peneliti</option>
               </select>
            </div>
          </div>

          <div class="form-group">
              <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
              <button type="submit" class="btn btn-success">Submit</button>
              </div>
          </div>

          <?php $random = str_random(10);
          session()->put('password', $random);?>

      </form>
    </div>
  </div>
@endsection

@section('script')
  <script src="{{ asset('js/select2.min.js') }}"></script>
  <script src="{{ asset('js/parsley.min.js') }}"></script>
  <script>
    CKEDITOR.replace( 'konten' );
  </script>
	<script type="text/javascript">
		$('.select2-multi').select2();
	</script>
@endsection
