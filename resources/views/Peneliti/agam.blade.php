<?php session()->put('flag', 3); ?>
@extends('layouts.PenelitiPartial.master')

@section('content')
<?php
  $tahun = Carbon\Carbon::now()->format('Y');
  $nama_lokasi = App\Cabang::where('id_cabang', $id)->value('nama_cabang');
  // dd((integer)$tahun);
?>
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Grafik Monitoring Data</h3>
  </div>
  <?php
    $file = Session::get('file');
    $id = Session::get('id');
    $alat = Session::get('alat');
    $cabang = App\Cabang::where('id_cabang', $id)->value('nama_cabang');
    // dd($cabang);
  ?>
  <div class="nav-tabs">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tahun1" data-toggle="tab"><?php echo (integer)$tahun; ?></a></li>
      <li><a href="#tahun2" data-toggle="tab"><?php echo (integer)$tahun-1; ?></a></li>
      <li><a href="#tahun3" data-toggle="tab"><?php echo (integer)$tahun-2; ?></a></li>
    </ul><br>
    <div class="tab-content">

      <div class="tab-pane active" id="tahun1">

        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Jan</a></li>
            <li><a href="#tab_2" data-toggle="tab">Feb</a></li>
            <li><a href="#tab_3" data-toggle="tab">Mar</a></li>
            <li><a href="#tab_4" data-toggle="tab">Apr</a></li>
            <li><a href="#tab_5" data-toggle="tab">Mei</a></li>
            <li><a href="#tab_6" data-toggle="tab">Jun</a></li>
            <li><a href="#tab_7" data-toggle="tab">Jul</a></li>
            <li><a href="#tab_8" data-toggle="tab">Agu</a></li>
            <li><a href="#tab_9" data-toggle="tab">Sep</a></li>
            <li><a href="#tab_10" data-toggle="tab">Oct</a></li>
            <li><a href="#tab_11" data-toggle="tab">Nov</a></li>
            <li><a href="#tab_12" data-toggle="tab">Des</a></li>
          </ul>
          <div class="tab-content">

            <div class="tab-pane active" id="tab_1">

              <?php
                $array = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun and $gabungBln == 1) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array)) { ?>
              <canvas id="myChart<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myChart<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_2">

              <?php
                $array1 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun and $gabungBln == 2) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array1)) { ?>
              <canvas id="myCharta<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array1, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myCharta<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_3">

              <?php
                $array2 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun and $gabungBln == 3) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array2)) { ?>
              <canvas id="myChartb<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array2, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myChartb<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_4">

              <?php
                $array3 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun and $gabungBln == 4) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array3)) { ?>
              <canvas id="myChartc<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array3, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myChartc<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_5">

              <?php
                $array4 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun and $gabungBln == 5) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array4)) { ?>
              <canvas id="myChartd<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array4, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myChartd<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_6">

              <?php
                $array5 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun and $gabungBln == 6) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array5)) { ?>
              <canvas id="myCharte<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array5, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myCharte<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_7">

              <?php
                $array6 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun and $gabungBln == 7) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array6)) { ?>
              <canvas id="myChartf<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array6, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myChartf<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_8">

              <?php
                $array7 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun and $gabungBln == 8) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array7)) { ?>
              <canvas id="myChartg<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array7, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myChartg<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_9">

              <?php
                $array8 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun and $gabungBln == 9) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array8)) { ?>
              <canvas id="myCharth<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array8, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myCharth<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_10">

              <?php
                $array9 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun and $gabungBln == 10) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array9)) { ?>
              <canvas id="myCharti<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array9, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myCharti<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>
            </div>

            <div class="tab-pane" id="tab_11">

              <?php
                $array10 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun and $gabungBln == 11) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array10)) { ?>
              <canvas id="myChartj<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array10, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myChartj<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_12">

              <?php
                $array11 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun and $gabungBln == 12) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array11)) { ?>
              <canvas id="myChartk<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array11, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myChartk<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

          </div>

        </div>

      </div>

      <div class="tab-pane" id="tahun2">

        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_13" data-toggle="tab">Jan</a></li>
            <li><a href="#tab_23" data-toggle="tab">Feb</a></li>
            <li><a href="#tab_33" data-toggle="tab">Mar</a></li>
            <li><a href="#tab_43" data-toggle="tab">Apr</a></li>
            <li><a href="#tab_53" data-toggle="tab">Mei</a></li>
            <li><a href="#tab_63" data-toggle="tab">Jun</a></li>
            <li><a href="#tab_73" data-toggle="tab">Jul</a></li>
            <li><a href="#tab_83" data-toggle="tab">Agu</a></li>
            <li><a href="#tab_93" data-toggle="tab">Sep</a></li>
            <li><a href="#tab_103" data-toggle="tab">Oct</a></li>
            <li><a href="#tab_113" data-toggle="tab">Nov</a></li>
            <li><a href="#tab_123" data-toggle="tab">Des</a></li>
          </ul>
          <div class="tab-content">

            <div class="tab-pane active" id="tab_13">

              <?php
                $array12 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun-1 and $gabungBln == 1) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array12)) { ?>
              <canvas id="myChartl<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array12, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myChartl<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_23">

              <?php
                $array13 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun-1 and $gabungBln == 2) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array13)) { ?>
              <canvas id="myChartm<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array13, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myChartm<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_33">

              <?php
                $array14 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun-1 and $gabungBln == 3) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array14)) { ?>
              <canvas id="myChartn<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array14, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myChartn<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_43">

              <?php
                $array15 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun-1 and $gabungBln == 4) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array15)) { ?>
              <canvas id="myCharto<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array15, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myCharto<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_53">

              <?php
                $array16 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun-1 and $gabungBln == 5) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array16)) { ?>
              <canvas id="myChartp<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array16, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myChartp<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_63">

              <?php
                $array17 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun-1 and $gabungBln == 6) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array17)) { ?>
              <canvas id="myChartq<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array17, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myChartq<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_73">

              <?php
                $array18 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun-1 and $gabungBln == 7) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array18)) { ?>
              <canvas id="myChartr<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array18, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myChartr<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_83">

              <?php
                $array19 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun-1 and $gabungBln == 8) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array19)) { ?>
              <canvas id="myCharts<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array19, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myCharts<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_93">

              <?php
                $array20 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun-1 and $gabungBln == 9) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array20)) { ?>
              <canvas id="myChartt<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array20, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myChartt<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_103">

              <?php
                $array21 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun-1 and $gabungBln == 10) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array21)) { ?>
              <canvas id="myChartu<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array21, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myChartu<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>
            </div>

            <div class="tab-pane" id="tab_113">

              <?php
                $array22 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun-1 and $gabungBln == 11) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array22)) { ?>
              <canvas id="myChartv<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array22, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myChartv<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_123">

              <?php
                $array23 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun-1 and $gabungBln == 12) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array23)) { ?>
              <canvas id="myChartw<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array23, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myChartw<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

          </div>

        </div>

      </div>

      <div class="tab-pane" id="tahun3">

        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_14" data-toggle="tab">Jan</a></li>
            <li><a href="#tab_24" data-toggle="tab">Feb</a></li>
            <li><a href="#tab_34" data-toggle="tab">Mar</a></li>
            <li><a href="#tab_44" data-toggle="tab">Apr</a></li>
            <li><a href="#tab_54" data-toggle="tab">Mei</a></li>
            <li><a href="#tab_64" data-toggle="tab">Jun</a></li>
            <li><a href="#tab_74" data-toggle="tab">Jul</a></li>
            <li><a href="#tab_84" data-toggle="tab">Agu</a></li>
            <li><a href="#tab_94" data-toggle="tab">Sep</a></li>
            <li><a href="#tab_104" data-toggle="tab">Oct</a></li>
            <li><a href="#tab_114" data-toggle="tab">Nov</a></li>
            <li><a href="#tab_124" data-toggle="tab">Des</a></li>
          </ul>
          <div class="tab-content">

            <div class="tab-pane active" id="tab_14">

              <?php
                $array24 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun-2 and $gabungBln == 1) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array24)) { ?>
              <canvas id="myChartx<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array24, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myChartx<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_24">

              <?php
                $array25 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun-2 and $gabungBln == 2) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array25)) { ?>
              <canvas id="myCharty<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array25, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myCharty<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_34">

              <?php
                $array26 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun-2 and $gabungBln == 3) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array26)) { ?>
              <canvas id="myChartz<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array26, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myChartz<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_44">

              <?php
                $array27 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun-2 and $gabungBln == 4) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array27)) { ?>
              <canvas id="myChartaa<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array27, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myChartaa<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_54">

              <?php
                $array28 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun-2 and $gabungBln == 5) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array28)) { ?>
              <canvas id="myChartbb<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array28, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myChartbb<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_64">

              <?php
                $array29 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun-2 and $gabungBln == 6) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array29)) { ?>
              <canvas id="myChartcc<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array29, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myChartcc<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_74">

              <?php
                $array30 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun-2 and $gabungBln == 7) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array30)) { ?>
              <canvas id="myChartdd<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array30, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myChartdd<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_84">

              <?php
                $array31 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun-2 and $gabungBln == 8) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array31)) { ?>
              <canvas id="myChartee<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array31, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myChartee<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_94">

              <?php
                $array32 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun-2 and $gabungBln == 9) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array32)) { ?>
              <canvas id="myChartff<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array32, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myChartff<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_104">

              <?php
                $array33 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun-2 and $gabungBln == 10) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array33)) { ?>
              <canvas id="myChartgg<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array33, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myChartgg<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>
            </div>

            <div class="tab-pane" id="tab_114">

              <?php
                $array34 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun-2 and $gabungBln == 11) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array34)) { ?>
              <canvas id="myCharthh<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array34, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myCharthh<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

            <div class="tab-pane" id="tab_124">

              <?php
                $array35 = array();
                foreach ($alat as $alats) {
                  $j = 0;
                  $k = 0;
                  $l = 0;
                  $m = 0;
                  // dd($alats);
                  foreach ($file as $files) {
                    if($files->getAttribute('id_cabang') == (integer)$id and $alats->getAttribute('id_alat') == $files->getAttribute('id_alat')) {
                      $itung = $files->getAttribute('current_time');
                      $gabungThn = $itung[0] * 1000 + $itung[1] * 100 + $itung[2] * 10 + $itung[3];
                      $gabungBln = $itung[5] * 10 + $itung[6];
                      $gabungTgl = $itung[8] * 10 + $itung[9];
                      if($gabungThn == (integer)$tahun-2 and $gabungBln == 12) {
                        if($gabungTgl <= 7) {
                          $j++;
                        }
                        elseif ($gabungTgl <= 14) {
                          $k++;
                        }
                        elseif ($gabungTgl <= 21) {
                          $l++;
                        }
                        elseif ($gabungTgl <= 31) {
                          $m++;
                        }
                      }
                    ?>

              <?php if(!in_array($alats->id_alat, $array35)) { ?>
              <canvas id="myChartii<?php echo $alats->id_alat; ?>" style="width: 700px; height: 200px; margin: 0 auto"></canvas>
              <?php }
                    array_push($array35, $alats->id_alat);
                  }
                }
              ?>

              <script>
                var data = {
                        labels: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31'],
                        datasets: [{
                            label: 'Jumlah Data',
                            data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    };
                var options = {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true,
                                  min: 0,
                                  stepSize: 1
                              }
                          }]
                      },
                    title: {
                      display: true,
                      text: ['<?php echo $alats->nama_alat; ?>', '<?php echo $cabang; ?>']
                    }
                  };
                var ctx = document.getElementById("myChartii<?php echo $alats->id_alat; ?>").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
              </script>
              <?php
              }
              ?>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>
@endsection
