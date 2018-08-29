<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <ul class="nav side-menu">
      <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Halaman Utama <span class="fa fa-chevron"></span></a>
      </li>
		<ul class="nav side-menu">
      <li><a><i class="fa fa-group"></i> Keanggotaan <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ route('lihatStaff.readAll') }}">Daftar Anggota</a></li>
          <li><a href="{{ route('tambahStaff.create') }}">Tambah Anggota</a></li>
        </ul>
      </li>
    <ul class="nav side-menu">
      <li><a><i class="fa fa-television"></i> Monitor Lokasi <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <?php
            use App\Cabang;
            $side = Cabang::orderBy('nama_cabang')->get();
          ?>
          @foreach ($side as $id)
          <li><a href="{{ route('lihat.agam', $id->id_cabang) }}">{{ $id->nama_cabang }}</a></li>
          @endforeach
        </ul>
      </li>
    <ul class="nav side-menu">

      <ul class="nav side-menu">
        <li><a><i class="fa fa-globe"></i> Lokasi Pengamatan <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{ route('DaftarCabang') }}">Daftar Lokasi Pengamatan</a></li>
            <li><a href="{{ route('tambahCabang') }}">Tambah Lokasi Pengamatan</a></li>
          </ul>
        </li>

        <ul class="nav side-menu">

          <ul class="nav side-menu">
            <li><a><i class="fa fa-wrench"></i> Daftar Alat <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="{{ route('DaftarAlat') }}">Daftar Alat</a></li>
                <li><a href="{{ route('tambahAlat') }}">Tambah Alat</a></li>
              </ul>
            </li>

    <li><a href="{{ route('laporan') }}"><i class="fa fa-file-text-o"></i>Laporan</a>
    </li>
  </div>
</div>
<!-- /sidebar menu -->
