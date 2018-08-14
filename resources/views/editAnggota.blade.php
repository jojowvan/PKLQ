@extends('templates.admins.master')

@section('stylesheets')

  <link href= "{{ asset('css/parsley.css') }}" rel="stylesheet">
  <link href= "{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
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

    <div class="x_panel">
        <div class="x_title">
            <h2>Edit Profile Anggota</h2>
            <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <br />
            <form class="form-horizontal form-label-left" action="#" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}


                    <div class="form-group">

                        <label class="control-label col-md-2">Foto Anggota
                        </label>
                        <div class="col-md-4">
                          <img src="#" alt="" style="width:200px;height:250px;">
                          <input type="file" class="form-control" name="image" value="#" >
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-2">
                            <a href="#" class="btn btn-round btn-primary">Back</a>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Nama Anggota
                          <span class="required">*</span>
                        </label>
                        <div class="col-md-9">
                        <input type="text" class="form-control" name="name" value="{{ ($user->name) }}" class="form-control col-md-9 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Nomor Identitas
                          <span class="required">*</span>
                        </label>
                        <div class="col-md-9">
                        <input type="text" class="form-control" name="firm" value="{{ $user->posisi }}">
                        </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-2">Jabatan</label>
                      <div class="col-md-9">
                        <select class="tags form-control program-multi" tabindex="-1" multiple="multiple" name="programs[]">

                            <option value="D3">D3</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>

                        </select>
                        <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                      </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
                        <a href="#" class="btn btn-danger">Cancel</a>
                        <button type="submit" class="btn btn-success">Update</button>
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

@endsection
