<?php session()->put('flag', 5); ?>
@extends('templates.admins.master')

@section('content')
  <div class="x_panel">
    <div class="col-md-6">
      <?php
      $id = Session::get('id');
      $nama_lokasi = App\Cabang::where('id_cabang', $id)->value('nama_cabang');
      ?>
      <h3>Monitoring Data Lokasi Pengamatan <?php echo $nama_lokasi; ?></h3>
    </div>
    <?php
      $tahun = Carbon\Carbon::now()->format('Y');
    ?>
    <div class="x_content">

      <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <ul id="myTab1" class="nav nav-tabs center" role="tablist">
          <li role="presentation" class="active"><a href="#tab_tahun1" id="home-tabb" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true"><?php echo (integer)$tahun; ?></a></li>
          <li role="presentation" class=""><a href="#tab_tahun2" role="tab" id="profile-tabb" data-toggle="tab" aria-controls="profile" aria-expanded="false"><?php echo (integer)$tahun-1; ?></a></li>
          <li role="presentation" class=""><a href="#tab_tahun3" role="tab" id="profile-tabb3" data-toggle="tab" aria-controls="profile" aria-expanded="false"><?php echo (integer)$tahun-2; ?></a></li>
        </ul>
        </br>
        <?php
          $file = Session::get('file');
          $alat = Session::get('alat');
        ?>
        <div id="myTabContent2" class="tab-content">
          <div role="tabpanel" class="tab-pane fade active in" id="tab_tahun1" aria-labelledby="home-tab">

            <div class="" role="tabpanel" data-example-id="togglable-tabs">
              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Jan</a></li>
                <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Feb</a></li>
                <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Mar</a></li>
                <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Apr</a></li>
                <li role="presentation" class=""><a href="#tab_content5" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Mei</a></li>
                <li role="presentation" class=""><a href="#tab_content6" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Jun</a></li>
                <li role="presentation" class=""><a href="#tab_content7" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Jul</a></li>
                <li role="presentation" class=""><a href="#tab_content8" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Agu</a></li>
                <li role="presentation" class=""><a href="#tab_content9" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Sep</a></li>
                <li role="presentation" class=""><a href="#tab_content10" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Okt</a></li>
                <li role="presentation" class=""><a href="#tab_content11" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Nov</a></li>
                <li role="presentation" class=""><a href="#tab_content12" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Des</a></li>
              </ul>

              <div id="myTabContent" class="tab-content">

                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                  <?php
                    $array = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containerjan<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> Januari <?php echo (integer)$tahun; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array)) { ?>
                        <div id="containerjan<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                  <?php
                    $array2 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containerfeb<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> Februari <?php echo (integer)$tahun; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array2)) { ?>
                        <div id="containerfeb<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array2, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                  <?php
                    $array3 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containermar<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> Maret <?php echo (integer)$tahun; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array3)) { ?>
                        <div id="containermar<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array3, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                  <?php
                    $array4 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containerapr<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> April <?php echo (integer)$tahun; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array4)) { ?>
                        <div id="containerapr<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array4, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">
                  <?php
                    $array5 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containermei<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> Mei <?php echo (integer)$tahun; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array5)) { ?>
                        <div id="containermei<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array5, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content6" aria-labelledby="profile-tab">
                  <?php
                    $array6 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containerjun<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> Juni <?php echo (integer)$tahun; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array6)) { ?>
                        <div id="containerjun<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array6, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content7" aria-labelledby="profile-tab">
                  <?php
                    $array7 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containerjul<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> Juli <?php echo (integer)$tahun; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array7)) { ?>
                        <div id="containerjul<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array7, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content8" aria-labelledby="profile-tab">
                  <?php
                    $array8 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containeragu<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> Agustus <?php echo (integer)$tahun; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array8)) { ?>
                        <div id="containeragu<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array8, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content9" aria-labelledby="profile-tab">
                  <?php
                    $array9 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containersep<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> September <?php echo (integer)$tahun; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array9)) { ?>
                        <div id="containersep<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array9, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content10" aria-labelledby="profile-tab">
                  <?php
                    $array10 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containerokt<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> Oktober <?php echo (integer)$tahun; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array10)) { ?>
                        <div id="containerokt<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array10, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content11" aria-labelledby="profile-tab">
                  <?php
                    $array11 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containernov<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> November <?php echo (integer)$tahun; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array11)) { ?>
                        <div id="containernov<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array11, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content12" aria-labelledby="profile-tab">
                  <?php
                    $array12 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containerdes<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> Desember <?php echo (integer)$tahun; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array12)) { ?>
                        <div id="containerdes<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array12, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
              </div>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane fade" id="tab_tahun2" aria-labelledby="profile-tab">
            <div class="" role="tabpanel" data-example-id="togglable-tabs">
              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tab_content17" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Jan</a></li>
                <li role="presentation" class=""><a href="#tab_content27" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Feb</a></li>
                <li role="presentation" class=""><a href="#tab_content37" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Mar</a></li>
                <li role="presentation" class=""><a href="#tab_content47" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Apr</a></li>
                <li role="presentation" class=""><a href="#tab_content57" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Mei</a></li>
                <li role="presentation" class=""><a href="#tab_content67" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Jun</a></li>
                <li role="presentation" class=""><a href="#tab_content77" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Jul</a></li>
                <li role="presentation" class=""><a href="#tab_content87" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Agu</a></li>
                <li role="presentation" class=""><a href="#tab_content97" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Sep</a></li>
                <li role="presentation" class=""><a href="#tab_content107" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Okt</a></li>
                <li role="presentation" class=""><a href="#tab_content117" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Nov</a></li>
                <li role="presentation" class=""><a href="#tab_content127" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Des</a></li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="tab_content17" aria-labelledby="home-tab">
                  <?php
                    $array1 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containerjan17<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> Januari <?php echo (integer)$tahun-1; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array1)) { ?>
                        <div id="containerjan17<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array1, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content27" aria-labelledby="profile-tab">
                  <?php
                    $array21 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containerfeb17<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> Februari <?php echo (integer)$tahun-1; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array21)) { ?>
                        <div id="containerfeb17<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array21, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content37" aria-labelledby="profile-tab">
                  <?php
                    $array3 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containermar17<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> Maret <?php echo (integer)$tahun-1; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array3)) { ?>
                        <div id="containermar17<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array3, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content47" aria-labelledby="profile-tab">
                  <?php
                    $array4 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containerapr17<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> April <?php echo (integer)$tahun-1; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array4)) { ?>
                        <div id="containerapr17<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array4, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content57" aria-labelledby="profile-tab">
                  <?php
                    $array5 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containermei17<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> Mei <?php echo (integer)$tahun-1; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array5)) { ?>
                        <div id="containermei17<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array5, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content67" aria-labelledby="profile-tab">
                  <?php
                    $array6 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containerjun17<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> Juni <?php echo (integer)$tahun-1; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array6)) { ?>
                        <div id="containerjun17<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array6, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content77" aria-labelledby="profile-tab">
                  <?php
                    $array7 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containerjul17<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> Juli <?php echo (integer)$tahun-1; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array7)) { ?>
                        <div id="containerjul17<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array7, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content87" aria-labelledby="profile-tab">
                  <?php
                    $array8 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containeragu17<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> Agustus <?php echo (integer)$tahun-1; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array8)) { ?>
                        <div id="containeragu17<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array8, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content97" aria-labelledby="profile-tab">
                  <?php
                    $array9 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containersep17<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> September <?php echo (integer)$tahun-1; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array9)) { ?>
                        <div id="containersep17<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array9, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content107" aria-labelledby="profile-tab">
                  <?php
                    $array10 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containerokt17<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> Oktober <?php echo (integer)$tahun-1; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array10)) { ?>
                        <div id="containerokt17<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array10, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content117" aria-labelledby="profile-tab">
                  <?php
                    $array11 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containernov17<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> November <?php echo (integer)$tahun-1; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array11)) { ?>
                        <div id="containernov17<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array11, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content127" aria-labelledby="profile-tab">
                  <?php
                    $array12 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containerdes17<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> Desember <?php echo (integer)$tahun-1; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array12)) { ?>
                        <div id="containerdes17<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array12, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
              </div>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane fade" id="tab_tahun3" aria-labelledby="profile-tab">
            <div class="" role="tabpanel" data-example-id="togglable-tabs">
              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tab_content16" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Jan</a></li>
                <li role="presentation" class=""><a href="#tab_content26" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Feb</a></li>
                <li role="presentation" class=""><a href="#tab_content36" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Mar</a></li>
                <li role="presentation" class=""><a href="#tab_content46" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Apr</a></li>
                <li role="presentation" class=""><a href="#tab_content56" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Mei</a></li>
                <li role="presentation" class=""><a href="#tab_content66" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Jun</a></li>
                <li role="presentation" class=""><a href="#tab_content76" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Jul</a></li>
                <li role="presentation" class=""><a href="#tab_content86" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Agu</a></li>
                <li role="presentation" class=""><a href="#tab_content96" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Sep</a></li>
                <li role="presentation" class=""><a href="#tab_content106" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Okt</a></li>
                <li role="presentation" class=""><a href="#tab_content116" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Nov</a></li>
                <li role="presentation" class=""><a href="#tab_content126" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Des</a></li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="tab_content16" aria-labelledby="home-tab">
                  <?php
                    $array1 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containerjanB<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> Januari <?php echo (integer)$tahun-2; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array1)) { ?>
                        <div id="containerjanB<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array1, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content26" aria-labelledby="profile-tab">
                  <?php
                    $array21 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containerfebB<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> Februari <?php echo (integer)$tahun-2; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array21)) { ?>
                        <div id="containerfebB<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array21, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content36" aria-labelledby="profile-tab">
                  <?php
                    $array3 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containermarB<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> Maret <?php echo (integer)$tahun-2; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array3)) { ?>
                        <div id="containermarB<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array3, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content46" aria-labelledby="profile-tab">
                  <?php
                    $array4 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containeraprB<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> April <?php echo (integer)$tahun-2; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array4)) { ?>
                        <div id="containeraprB<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array4, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content56" aria-labelledby="profile-tab">
                  <?php
                    $array5 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containermeiB<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> Mei <?php echo (integer)$tahun-2; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array5)) { ?>
                        <div id="containermeiB<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array5, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content66" aria-labelledby="profile-tab">
                  <?php
                    $array6 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containerjunB<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> Juni <?php echo (integer)$tahun-2; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array6)) { ?>
                        <div id="containerjunB<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array6, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content76" aria-labelledby="profile-tab">
                  <?php
                    $array7 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containerjulB<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> Juli <?php echo (integer)$tahun-2; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array7)) { ?>
                        <div id="containerjulB<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array7, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content86" aria-labelledby="profile-tab">
                  <?php
                    $array8 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containeraguB<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> Agustus <?php echo (integer)$tahun-2; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array8)) { ?>
                        <div id="containeraguB<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array8, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content96" aria-labelledby="profile-tab">
                  <?php
                    $array9 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containersepB<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> September <?php echo (integer)$tahun-2; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array9)) { ?>
                        <div id="containersepB<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array9, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content106" aria-labelledby="profile-tab">
                  <?php
                    $array10 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containeroktB<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> Oktober <?php echo (integer)$tahun-2; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array10)) { ?>
                        <div id="containeroktB<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array10, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content116" aria-labelledby="profile-tab">
                  <?php
                    $array11 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containernovB<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> November <?php echo (integer)$tahun-2; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array11)) { ?>
                        <div id="containernovB<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array11, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content126" aria-labelledby="profile-tab">
                  <?php
                    $array12 = array();
                    foreach ($alat as $alats) {
                      $j = 0;
                      $k = 0;
                      $l = 0;
                      $m = 0;
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
                        <script type="text/javascript">
                          var chart1; // globally available
                          $(document).ready(function() {
                            chart1 = new Highcharts.Chart({
                              chart: {
                                renderTo: 'containerdesB<?php echo $alats->id_alat; ?>',
                                type: 'line'
                                },
                                title: {
                                text: '<?php echo $alats->nama_alat; ?>'
                                },
                                subtitle: {
                                text: '<?php echo $nama_lokasi?> Desember <?php echo (integer)$tahun-2; ?>',
                                },
                                xAxis: {
                                categories: ['Tanggal 1-7', 'Tanggal 8-14', 'Tanggal 15-21', 'Tanggal 22-31']
                                },
                                yAxis: {
                                  min: 0,
                                  allowDecimals: false,
                                title: {
                                  text: 'Data'
                                }
                                },
                                plotOptions: {
                                line: {
                                  dataLabels: {
                                  enabled: true
                                  },
                                  enableMouseTracking: false
                                }
                                },
                                series: [{
                                name: 'Jumlah Data',
                                data: [<?php echo $j; ?>, <?php echo $k; ?>, <?php echo $l; ?>, <?php echo $m; ?>]
                                }]
                            });
                          });
                        </script>
                        <!-- fungsi yang di tampilkan dibrowser -->
                        <?php if(!in_array($alats->id_alat, $array12)) { ?>
                        <div id="containerdesB<?php echo $alats->id_alat; ?>" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <?php }
                          array_push($array12, $alats->id_alat);
                        }
                      }
                    }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
