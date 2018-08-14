<!DOCTYPE html>
<html>
@include('layouts.kapusPartial.head')

<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

@include('layouts.kapusPartial.header')

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="">
          <a href="{{ route('admin.dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Charts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/agam"><i class="fa fa-circle-o"></i> Agam</a></li>
            <li><a href="/biak"><i class="fa fa-circle-o"></i> Biak</a></li>
            <li><a href="/garut"><i class="fa fa-circle-o"></i> Garut</a></li>
            <li><a href="/kupang"><i class="fa fa-circle-o"></i> Kupang</a></li>
            <li><a href="/manado"><i class="fa fa-circle-o"></i> Manado</a></li>
            <li><a href="/pasuruan"><i class="fa fa-circle-o"></i> Pasuruan</a></li>
            <li><a href="/pontianak"><i class="fa fa-circle-o"></i> Pontianak</a></li>
            <li><a href="/sumedang"><i class="fa fa-circle-o"></i> Sumedang</a></li>
            <li><a href="/yogyakarta"><i class="fa fa-circle-o"></i> Yogyakarta</a></li>
          </ul>
        </li>
        {{--  hapus dibawah ini  --}}
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      @yield('title')
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    @yield('content')
      <!-- Default box -->

      <!-- /.box -->
    </section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@include('layouts.kapusPartial.footer')

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include('layouts.kapusPartial.script')
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
</body>
</html>
