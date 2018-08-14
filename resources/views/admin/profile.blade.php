@extends('templates.admins.master')


@section('content')
  <div class="col-md-12 col-sm-12 col-xs-12">
      @if (session()->has('passwordChanged'))
      <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong> {{session()->get('passwordChanged')}} </strong>
      </div>
    @endif

    
    @if (session()->has('profileNotif'))
      <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong> {{session()->get('profileNotif')}} </strong>
      </div>
    @endif

    @if (session()->has('invalidPassword'))
      <div class="alert alert-danger alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong> {{session()->get('invalidPassword')}} </strong>
      </div>
    @endif

    
    <div class="x_panel">
      <div class="x_title">
        <h2>Profile</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
          <div class="profile_img">
            <div id="crop-avatar">
              <!-- Current avatar -->
              <img class="img-responsive avatar-view" src="/storage/{{Auth::user()->avatar}}" alt="Avatar" title="Change the avatar" height="10">
            </div>
          </div>
          <h3>{{$admins->name}}</h3>

          <ul class="list-unstyled user_data">
            <li><i class="fa fa-map-marker user-profile-icon"></i> {{$admins->address}}
            </li>

            <li>
              <i class="fa fa-briefcase user-profile-icon"></i> {{$admins->jobPosition}}
            </li>

  
          </ul>

          {{--  <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
          <br />  --}}


        </div>
        <div class="col-md-9 col-sm-9 col-xs-12">
            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Edit Profile</a>
                  </li>
                  <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Change Password</a>
                  </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                  <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                    <!-- start Edit Profile -->
                    <br><br><br>
                    <form id="demo-form2" method="post" action="{{ route('admin.update') }}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }} 

                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="first-name">Change Photo
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">  
                              <input type="file" id="first-name" name="avatar" value="{{ old('name', $admins->avatar) }}" class="form-control col-md-7 col-xs-12">
                            </div>
                          </div>

                        <div class="form-group">
                          <label class="col-md-4 control-label" for="first-name">Name <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">  
                            <input type="text" id="first-name" name="name" value="{{ old('name', $admins->name) }}" required="required" class="form-control col-md-7 col-xs-12">
                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-4 control-label" for="last-name">Email <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="email" id="last-name" name="email" value="{{ old('email', $admins->email) }}" required="required" class="form-control col-md-7 col-xs-12">
                            <span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label for="middle-name" class="col-md-4 control-label">Job Position<span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="jobPosition" value="{{ old('jobPosition', $admins->jobPosition) }}" required="required">
                            <span class="fa fa-briefcase form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-md-4 control-label">Address<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="birthday" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" name="address" value="{{ old('address', $admins->address) }}">
                            <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div>  
                      
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-success">
                                Submit
                              </button>
                            </div>
                          </div>

  
                      </form>
                    <!-- end Edit Profile -->

                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                    <!-- start user projects -->
                    <br><br><br>

                    <form class="form-horizontal" method="POST" action="{{ route('admin.password') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                          <label for="new-password" class="col-md-4 control-label">Current Password</label>
                          <div class="col-md-6">
                            <input id="current-password" type="password" class="form-control" name="current-password" value="{{ old('current-password') }}" required>
                            @if ($errors->has('current-password'))
                              <span class="help-block">
                              <strong>{{ $errors->first('current-password') }}</strong>
                              </span>
                            @endif
                          </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                          <label for="new-password" class="col-md-4 control-label">New Password</label>
                          <div class="col-md-6">
                            <input id="new-password" type="password" class="form-control" name="new-password" required>
                            @if ($errors->has('new-password'))
                              <span class="help-block">
                              <strong>{{ $errors->first('new-password') }}</strong>
                              </span>
                            @endif
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label for="new-password-confirm" class="col-md-4 control-label">Confirm New Password</label>
                          <div class="col-md-6">
                            <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                          </div>
                        </div>
                            
                        <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                              Change Password
                            </button>
                          </div>
                        </div>
                        </form>

                  </div>
                  
                </div>
              </div>
        </div> 
      </div>
    </div>
  </div>


 



@endsection