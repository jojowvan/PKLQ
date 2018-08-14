<!DOCTYPE html>
<html lang="en">

  @include('templates.adminPartials.head')

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{ route('admin.dashboard') }}" class="site_title"><img src="{{ asset('assets/img/8.png') }}" height="50px" widht="50px"><span> LAPAN </span></a>
            </div>
            <div class="clearfix"></div>
            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <!-- <img src="/storage/{{Auth::user()->avatar}}" alt="..." class="img-circle profile_img"  width="100" height="60"> -->
                <img src="{{ asset('assets/img/Picture1.png') }}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Selamat datang,</span>
                <h2>{{ Auth::user()->name }} </h2>
              </div>
            </div>
            <!-- /menu profile quick info -->
            <br/>

            @include('templates.adminPartials.sidebar')

          </div>
        </div>
        <!-- top navigation -->
        @include('templates.adminPartials.nav')

        <div class="right_col" role="main">
          <div class="">
            <!-- <div class="page-title">
              <div class="title_left">
                <h3>@yield('title')</h3>
            </div>
            </div> -->

            @yield('content')

          </div>
        </div>

        @include('templates.adminPartials.footer')

      </div>
    </div>

    @include('templates.adminPartials.script')

    @yield('script')

  </body>
</html>
