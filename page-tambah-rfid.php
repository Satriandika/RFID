<?php

require_once("koneksidb.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$data = query("SELECT * FROM tb_monitoring")[0];
$rfid_monitor = $data["rfid"] ?? ""; 
$rfid = $_GET["rfid"] ?? null;
if($rfid) {
    $res = queryfirst("SELECT * from tb_daftarrfid where rfid = '$rfid'");
    if(count($res) > 0) {
        echo "<script type='text/javascript'>alert('RFID sudah terdaftar');</script>";
        $rfid = null;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tambah RFID</title>
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
    if ($_SESSION['status'] != "login") {
        header("location:index.php?pesan=belum_login");
    }

    if (isset($_GET['pesan'])) {
        if ($_GET['pesan'] == "berhasil") {
            echo "<script type='text/javascript'>alert('Berhasil menambahkan data!');</script>";
        } else {
            echo "<script type='text/javascript'>alert('Gagal menambahkan data');</script>";
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
                                <i class="mdi mdi-account-multiple-plus"></i>
                            </span> Add RFID
                        </h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">RFID Form</h4>
                                    <form class="forms-sample" action="action-tambah-rfid.php" method="POST" name="form-input-data">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">RFID</label>
                                            <input type="text" class="form-control"  value="<?=$rfid??""?>"name="rfid" id="exampleInputUsername1" placeholder="Masukkan RFID">
                                            <a class="nav-link" href="page-tambah-rfid.php?rfid=<?=$rfid_monitor?>">Get RFID</a>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control" name="nama" placeholder="Masukkan nama">
                                        </div>

                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea name="alamat" cols="30" rows="5" class="form-control" placeholder="Masukkan alamat"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="telepon">Telepon</label>
                                            <input type="text" class="form-control" name="telepon" placeholder="Masukkan telepon">
                                        </div>


                                        <div class="form-group">
                                            <label for="saldo">Saldo Awal</label>
                                            <input type="number" class="form-control" name="saldo" placeholder="Masukkan saldo">
                                        </div>

                                        <input type="submit" name="submit" value="Submit" class="btn btn-gradient-primary mr-2">
                                        <a onclick="cancelSubmit()" class="btn btn-light">Cancel</a>
                                    </form>
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
            <script>
                function cancelSubmit() {
                    console.log("test");
                    window.location = "page-tambah-rfid.php";
                }
            </script>
            <!-- End custom js for this page -->

            <!-- JS For Realtime -->
            <script type="text/javascript" src="time/datetime.js"></script>
            <script type="text/javascript">window.onload = date_time('time/date_time');</script>
            <!-- END JS For Realtime -->
</body>

</html>