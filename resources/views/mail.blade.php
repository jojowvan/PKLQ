<?php
  use Session;
  $tahun = Session::get('tahun');
  $bulan = Session::get('bulan');
?>
Selamat pagi,
<br><br>
Berikut kami sampaikan laporan monitoring data pada bulan <?php echo($bulan); echo(' '); echo($tahun); ?>
<br><br>
Terima Kasih
<br><br><br>
Tim Monitoring Data,
<br>
PUSSAINSA
