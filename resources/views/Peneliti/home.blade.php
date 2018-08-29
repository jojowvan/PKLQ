<?php session()->put('flag', 0); ?>
@extends('layouts.PenelitiPartial.master')

@section('title')
<!-- Main content -->
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3>{{DB::table('cabang')->count()}}</h3>

                <p>Lokasi Pengamatan</p>
              </div>
              <div class="icon">
                <i class="ion fa-map-pin"></i>
              </div>
            </div>
          </div>

          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>{{ DB::table('alat')->count() }}</h3>

                  <p>Alat</p>
                </div>
                <div class="icon">
                  <i class="fa fa-wrench"></i>
                </div>
              </div>
            </div>
@endsection

@section('content')

<?php
  $IP     = App\Cabang::orderBy('id_cabang')->get();
  $i = 0;
  $cabang = array();
  $output = array();
  $longlat = array();
  foreach ($IP as $IPs) {
    $id = $IPs->getAttribute('id_cabang');
    $ping = $IPs->getAttribute('ip_server');
    $name = $IPs->getAttribute('nama_cabang');
    $longitude = $IPs->getAttribute('longitude');
    $latitude = $IPs->getAttribute('latitude');
    $cabang[$i] = shell_exec('ping -n 1 '. $ping);  //kalo ga sekali compiling time nya besar
    $output[$i] = strpos($cabang[$i], 'Reply');
    $longlat[$i] = [$name, (float)$latitude, (float)$longitude, (int)$id];
    $i++;
  }
 ?>

<head>
  <style>
    #map-canvas {
      width: 1000px;
      height: 500px;
    }
  </style>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbJw9v5SiIYxzP5Z3gHHpVwlahVkWapk0&callback=initialize"></script>
  <script type="text/javascript">
  var markers = <?php echo json_encode($longlat); ?>;
    function initialize() {
      var mapCanvas = document.getElementById('map-canvas');
      var mapOptions = {
        scrollwheel: false,
        navigationControl: false,
        mapTypeControl: false,
        scaleControl: false,
        draggable: true,
        minZoom: 5,
        maxZoom: 7,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      }
      var map = new google.maps.Map(mapCanvas, mapOptions)
      var infowindow = new google.maps.InfoWindow(), marker, i;
      var bounds = new google.maps.LatLngBounds(); // diluar looping
      var daerah = <?php echo json_encode($output);?>;
      for (i = 0; i < markers.length; i++) {
        pos = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(pos); // di dalam looping
        if(daerah[i] > 0){
          marker = new google.maps.Marker({
              position: pos,
              map: map,
              animation:google.maps.Animation.BOUNCE,
              icon:'biru2.png',
            });
          }
          else {
            marker = new google.maps.Marker({
                position: pos,
                map: map,
                icon:'merah2.png',
            });
          }
          google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
          return function() {
              infowindow.setContent(markers[i][0]);
              infowindow.open(map, marker);
          }
          })
          (marker, i));
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
            infowindow.setContent(markers[i][0]);
            infowindow.open(map, marker);
            window.location.href = `admin/lihatCabang/${markers[i][3]}`;
        }
        })
        (marker, i));
        map.fitBounds(bounds); // setelah looping
      }
    }
    google.maps.event.addDomListener(window, 'load', initialize);
  </script>
</head>
<body>
  <div id="map-canvas"></div>
  <br>
  <div class="cleafix"></div>
</body>
@endsection
