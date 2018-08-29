<!DOCTYPE html>
<html>
@include('layouts.PenelitiPartial.head')

<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

@include('layouts.PenelitiPartial.header')

<!-- =============================================== -->

<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('..\public\assets\img\profil.png')}}" class="user-image" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><span>Selamat datang,</span></p>
        <p>{{ Auth::user()->name }} </p>
        <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
      </div>
    </div>
    <!-- search form -->
    <!-- <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
           </span>
      </div>
    </form> -->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Navigasi Utama</li>
      <li class="">
        <a href="{{ route('admin.dashboard')}}">
          <i class="fa fa-dashboard"></i> <span>Halaman Utama</span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-line-chart"></i>
          <span>Monitor Lokasi</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <?php
            use App\Cabang;
            $side = Cabang::orderBy('nama_cabang')->get();
          ?>
          @foreach ($side as $id)
          <li><a href="{{route('kapuslihat.agam', $id->id_cabang) }}"> {{$id->nama_cabang}} </a></li>
          @endforeach
        </ul>
      </li>
      <li class="">
        <a href="{{ route('daftarAlat2')}}">
          <i class="fa fa-file-o"></i> <span>Daftar Alat</span>
        </a>
      </li>
      <li class="">
        <a href="{{ route('lihatFile1')}}">
          <i class="fa fa-folder-open-o"></i> <span>Daftar Fail</span>
        </a>
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
@include('layouts.PenelitiPartial.footer')

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include('layouts.PenelitiPartial.script')
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
</body>
</html>
