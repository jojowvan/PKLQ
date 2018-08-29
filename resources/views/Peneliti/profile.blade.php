<?php session()->put('flag', 99); ?>
@extends('layouts.PenelitiPartial.master')

@section('stylesheets')
  <link href= "{{ asset('css/parsley.css') }}" rel="stylesheet">
  <link href= "{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="x_panel">
    <div class="x_title">
      <h2>Ubah Kata Sandi</h2>
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

      @if (session()->has('invalidPassword'))
        <div class="alert alert-danger alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <strong> {{session()->get('invalidPassword')}} </strong>
        </div>
      @endif
      {{-- end alert --}}

      <form class="form-horizontal form-label-left" method="POST" action="{{route('ganti.password')}}">
        <!-- {{method_field('PATCH')}} -->
        @csrf

        <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
          <label for="new-password" class="control-label col-md-2">Kata Sandi Lama<span class="required">*</span></label>
          <div class="col-md-4">
            <input id="current-password" type="password" class="form-control" name="current-password" value="{{ old('current-password') }}" required>
            @if ($errors->has('current-password'))
              <span class="help-block">
              <strong>{{ $errors->first('current-password') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
          <label for="new-password" class="control-label col-md-2">Kata Sandi Baru<span class="required">*</span></label>
          <div class="col-md-4">
            <input id="new-password" type="password" class="form-control" name="new-password" required>
            @if ($errors->has('new-password'))
              <span class="help-block">
              <strong>{{ $errors->first('new-password') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label for="new-password-confirm" class="control-label col-md-2">Konfirmasi Kata Sandi<span class="required">*</span></label>
          <div class="col-md-4">
            <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <button type="submit" class="btn btn-success">
              Simpan
            </button>
          </div>
        </div>

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
