<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
require_once("koneksidb.php");

$data = query("SELECT * FROM tb_monitoring")[0];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Log Data</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">

  <link rel="stylesheet" type="text/css" href="assets/vendors/datatables/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" type="text/css" href="assets/vendors/datatables/css/buttons.bootstrap4.css">
  <link rel="stylesheet" type="text/css" href="assets/vendors/datatables/css/select.bootstrap4.css">
  <link rel="stylesheet" type="text/css" href="assets/vendors/datatables/css/fixedHeader.bootstrap4.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="assets/images/delameta.ico" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
      <?php
        require("page-header.php");
      ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php
      require("page-sidebar.php");
      ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-chart-bar"></i>
              </span> Log Data
            </h3>
          </div>
          <div class="row">
            <div class="col-lg-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Transactions Data Log</h4>
                  <!-- <p class="card-description"> Add class <code>.table-{color}</code> -->
                  </p>
                  <table id=example class="table table-bordered table-striped second">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>RFID</th>
                        <th>Nama</th>
                        <th>Saldo Awal</th>
                        <th>Harga</th>
                        <th>Saldo Akhir</th>
                        <th>Nama Tol</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      $datatampil = mysqli_query($koneksi, "SELECT *, a.rfid as rfid from tb_simpan a left join tb_daftarrfid b on a.rfid = b.rfid ORDER BY no DESC");
                      $no = 1;
                      if (is_array($datatampil) || is_object($datatampil)) {
                        foreach ($datatampil as $row) {
                          echo "<tr class= bg-white >
                                  <td>$no</td>
                                  <td>" . $row['tanggal'] . "</td>
                                  <td>" . $row['rfid'] . "</td>
                                  <td>" . $row['nama'] . "</td>
                                  <td>" . $row['saldoawal'] . "</td>
                                  <td>" . $row['harga'] . "</td>
                                  <td>" . $row['saldoakhir'] . "</td>
                                  <td>" . $row['tol'] . "</td>
                                  <td>" . $row['status_transaksi'] . "</td>
                              </tr>";
                          $no++;
                        }
                      }

                      $koneksi->close();
                      ?>

                  </table>
                </div>
              </div>

            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
              <div class="container-fluid clearfix">
                <span class="text-muted d-block text-center float-sm-right d-sm-inline-block">Copyright © PT Delameta Bilano 2021</span>
              </div>
            </footer>
            <!-- partial -->
          </div>
          <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
      </div>
      <!-- container-scroller -->
      <!-- plugins:js -->
      <script src="assets/vendors/js/vendor.bundle.base.js"></script>
      <!-- endinject -->
      <!-- Plugin js for this page -->
      <script src="assets/vendors/chart.js/Chart.min.js"></script>
      <!-- End plugin js for this page -->
      <!-- inject:js -->
      <script src="assets/js/off-canvas.js"></script>
      <script src="assets/js/hoverable-collapse.js"></script>
      <script src="assets/js/misc.js"></script>
      <!-- endinject -->
      <!-- Custom js for this page -->
      <script src="assets/js/dashboard.js"></script>
      <script src="assets/js/todolist.js"></script>
      <!-- data tables -->
      <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
      <script src="assets/vendors/datatables/js/dataTables.bootstrap4.min.js"></script>
      <script src="assets/vendors/datatables/js/buttons.bootstrap4.min.js"></script>
      <script src="assets/vendors/datatables/js/data-table.js"></script>

      <!-- End custom js for this page -->
      
      <!-- JS For Realtime -->
      <script type="text/javascript" src="time/datetime.js"></script>
      <script type="text/javascript">window.onload = date_time('time/date_time');</script>
      <!-- END JS For Realtime -->
</body>

</html>