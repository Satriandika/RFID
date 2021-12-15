<?php

//Simpan dengan nama file panel.php
require "koneksidb.php";

?>

<!DOCTYPE html>
<html lang="en">
<!-- test commit -->

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Tambah Tol</title>
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

  if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "berhasil") {
      echo "<script type='text/javascript'>alert('Berhasil menambahkan data!');</script>";
    }
    if ($_GET['pesan'] == "gagal") {
      echo "<script type='text/javascript'>alert('Tidak berhasil menambahkan data');</script>";
    }
  }
  ?>

  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php
    require_once("page-header.php");
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
                <i class="mdi mdi-road"></i>
              </span> Menu Tambah Tol
            </h3>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Tambah Tol</h4>
                  <p class="card-description">Masukkan id tol dan harga</p>
                  <form action="action-tambah-tol.php" method="POST" class="forms-sample">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Id tol</label>
                      <input type="text" class="form-control" name="idtol" id="rfid" placeholder="Masukan id tol">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Harga</label>
                      <input type="number" class="form-control" name="harga" placeholder="Masukan harga">
                    </div>
                    <button type="submit" name="submit" value="Submit" class="btn btn-gradient-primary mr-2">Submit</button>
                    <button onclick="cancelSubmit()" class="btn btn-light">Cancel</button>
                  </form>
                </div>
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
    <!-- End custom js for this page -->
    <script>
      function cancelSubmit() {
        window.location = "page-tambah-tol.php";
      }
    </script>
</body>

</html>