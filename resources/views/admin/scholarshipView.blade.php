@extends('templates.admins.master')

@section('stylesheets')
  <style>
      .unstyled-button {
        border: none;
        padding: 200;
        background: none;
        
      }  
  </style>   
@endsection

@section('content')
  <div class="col-md-12 col-sm-12 col-xs-12">
      @if (session()->has('notif'))
        <div class="alert alert-success alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <strong> {{session()->get('notif')}} </strong>
        </div>
      @endif
    <div class="x_panel">
      {{--  <div class="x_title">  --}}
        <h2>{{$scholarships->name}}</h2>
        <div class="clearfix"></div>
        <small>Posted by Admin on {{$scholarships->getDate()}}</small>
      {{--  </div>  --}}
      <br><br>

      <div class="row">
        <div class="col-md-2 col-md-offset-5">
            <img src="{{$scholarships->getImage()}}" alt="" style="width:200px;height:250px;">    
        </div>
    </div>

    <br><br>

      <div class="" role="tabpanel" data-example-id="togglable-tabs">
          <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Deskripsi</a>
            </li>
            <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Komentar</a>
            </li>
          </ul>
          <div id="myTabContent" class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

              <!-- start Deskripsi -->

            <div class="form-group">
              <div class="col-md-9 col-md-offset-1">
                <b>Syarat:</b>
                <ul>
                  <li>Program     : {{$requirements->program}} </li>
                  <li>Fakultas    : {{$requirements->faculty}} </li>
                  <li>Semester    : {{$requirements->semester}} </li>
                  <li>IPK minimal : {{$requirements->gda}} </li>
                </ul>
              </div>
              <div class="col-md-2">
                <form action="{{ route('editScholarship.destroy', $scholarships->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }} 
                  <div class="btn-group">
                    <button type="button" class="btn btn-primary">Option</button>
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li>
                       
                        
                        <button type="" class="unstyled-button">
                           <a href="{{ route('editScholarship.edit', $scholarships->id) }}">
                             Edit
                           </a>
                        </button>
                        
                      </li>
                      <li>
                        
                        <button type="submit" onclick="deleteConfirm()"  class="unstyled-button">Delete</button>
                        
                          
                      </li>
                    </ul>
                  </div>

                  <script>
                      function deleteConfirm() {
                        event.preventDefault(); // prevent form submit
                        var form = event.target.form; // storing the form
                          swal({
                            title: "Are you sure?",
                            text: "You will not be able to recover this Scholarship!",         type: "warning",   
                            showCancelButton: true,   
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Yes, delete it!", 
                            closeOnConfirm: false 
                        },
                        function(isConfirm){
                          if (isConfirm) {
                            form.submit();          // submitting the form when user press yes
                          } 
                        });
                        }
                  </script>

                </form>
                  
              </div>
            </div>

            
            
            <br>
            <div class="col-md-2">
                
                {{--  <a href="{{ route('editScholarship.edit', $scholarships->id) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i>Edit</a>  --}}
            </div>
            <div class="col-md-9 col-md-offset-1">
              <br><br>
              {!! $scholarships->description !!}

              <br>
              <div class="tags">
                <h4><b>Tags:</b></h4>
                @foreach ($scholarships->tags as $tag)
                   <span class="label label-default">{{ $tag->name }}</span>
                @endforeach
              </div>

            </div>

            
            

         
              
              <!-- end recent activity -->

            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

              <!-- start user projects -->
              
              <!-- end user projects -->

            </div>
            
          </div>
        </div>

      

      
      </div>
    </div>
  </div>

 

  @include('sweet::alert')

@endsection

