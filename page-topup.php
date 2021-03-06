<?php

//Simpan dengan nama file panel.php
require "koneksidb.php";
$data    = query("SELECT * FROM tb_monitoring")[0];
$rfid = 0;

if (isset($_GET['getRFID'])) {
  $rfid = 1;
}

?>

<!DOCTYPE html>
<html lang="en">
<!-- test commit -->

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Top Up</title>
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
  <?php
  session_start();
  if ($_SESSION['status'] != "login") {
    header("location:index.php?pesan=belum_login");
  }

  $saldo = $_GET["saldo"] ?? "";

  if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "berhasil") {
      echo "<script type='text/javascript'>alert('Berhasil topup! Saldo sekarang: $saldo');</script>";
    }
    if ($_GET['pesan'] == "gagal") {
      echo "<script type='text/javascript'>alert('Data Tidak Terdaftar!');</script>";
    }
  }
  ?>

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
                <i class="mdi mdi-currency-usd"></i>
              </span> Menu Top Up
            </h3>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Top Up</h4>
                  <p class="card-description">Masukkan RFID dan Nominal</p>
                  <form action="action-topup.php" method="POST" name="form-page-topup" class="forms-sample">
                    <div class="form-group">
                      <label for="exampleInputUsername1">RFID</label>
                      <?php
                      if ($rfid == 1) {
                      ?>
                        <input type="text" class="form-control" name="rfid" id="rfid" placeholder="Masukan rfid" value="<?= $data['rfid'] ?>">
                      <?php
                      } else {
                      ?>
                        <input type="text" class="form-control" name="rfid" id="rfid" placeholder="Masukan rfid">
                      <?php
                      }
                      ?>
                      <a href="page-topup.php?getRFID=true" class="btn btn-link">Get RFID</a>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nominal</label>
                      <input type="number" class="form-control" name="topup" placeholder="Masukan jumlah topup">
                    </div>
                    <button type="submit" name="Submit" value="Submit" class="btn btn-gradient-primary mr-2">Submit</button>
                    <a onclick="cancelSubmit()" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid clearfix">
              <span class="text-muted d-block text-center float-sm-right d-sm-inline-block">Copyright ?? PT Delameta Bilano 2021</span>
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
    <!-- End custom js for this page -->
    <script>
      function cancelSubmit() {
        window.location = "page-topup.php";
      }
    </script>
    <!-- JS For Realtime -->
    <script type="text/javascript" src="time/datetime.js"></script>
    <script type="text/javascript">
      window.onload = date_time('time/date_time');
    </script>
    <!-- END JS For Realtime -->
</body>

</html>