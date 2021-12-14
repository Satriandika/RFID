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
  <title>RFID Data</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
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
    require_once("page-navbar.php");
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
                  <h4 class="card-title">RFID DATA</h4>
                  <!-- <p class="card-description"> Add class <code>.table-{color}</code> -->
                  </p>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>RFID</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Saldo</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      $datatampil = mysqli_query($koneksi, "SELECT *from tb_daftarrfid ORDER BY id DESC");
                      $no = 1;
                      if (is_array($datatampil) || is_object($datatampil)) {
                        foreach ($datatampil as $row) {
                          echo "<tr class= bg-white >
                                  <td>" . $no . "</td>
                                  <td>" . $row['rfid'] . "</td>
                                  <td>" . $row['nama'] . "</td>
                                  <td>" . $row['alamat'] . "</td>
                                  <td>" . $row['telepon'] . "</td>
                                  <td>" . $row['saldo'] . "</td>
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
      <!-- <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <script src="assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
      <script src="assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>
      <script src="assets/vendor/datatables/js/data-table.js"></script> -->
      <!-- End custom js for this page -->
</body>

</html>