<!DOCTYPE html>
<html lang="en">
<!-- test comment -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
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
            echo "<script type='text/javascript'>alert('Anda telah berhasil login!');</script>";
        }
    }
    ?>

    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="index.html"><img src="assets/images/delameta2.svg" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <div class="search-field d-none d-md-block">
                    <form class="d-flex align-items-center h-100" action="#">
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                                <i class="input-group-text border-0 mdi mdi-magnify"></i>
                            </div>
                            <input type="text" class="form-control bg-transparent border-0" placeholder="Search">
                        </div>
                    </form>
                </div>
                <!-- Waktu otomatis -->
                <ul class="navbar-nav navbar-nav-right">
                    <div style="float: right;margin-right: 10px;" class="font-weight-bold">
                        <span id="time/date_time"></span>
                    </div>
                    <!-- END Waktu otomatis -->
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                                <div class="nav-profile-img">
                                    <img src="assets/images/faces/admin.png" alt="image">
                                    <span class="availability-status online"></span>
                                </div>
                                <div class="nav-profile-text">
                                    <p class="mb-1 text-black">Admin</p>
                                </div>
                            </a>
                            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="mdi mdi-cached mr-2 text-success"></i> Activity Log </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">
                                    <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
                            </div>
                        </li>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-profile">
                        <a href="#" class="nav-link">
                            <div class="nav-profile-image">
                                <img src="assets/images/faces/admin.png" alt="profile">
                                <span class="login-status online"></span>
                                <!--change to offline or busy as needed-->
                            </div>
                            <div class="nav-profile-text d-flex flex-column">
                                <span class="font-weight-bold mb-2">Admin</span>
                                <span class="text-secondary text-small">Trainee</span>
                            </div>
                            <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link border-bottom" href="index.html">
                            <span class="menu-title">Dashboard</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="log-data.html">
                            <span class="menu-title">Log Transaksi</span>
                            <i class="mdi mdi-chart-bar menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="data-api.php">
                            <span class="menu-title">Tambah RFID</span>
                            <i class="mdi mdi-account-multiple-plus menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/charts/chartjs.html">
                            <span class="menu-title">Data Pengguna</span>
                            <i class="mdi mdi-chart-bar menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="topup.html">
                            <span class="menu-title">Menu Top Up</span>
                            <i class="mdi mdi-currency-usd menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item sidebar-actions">
                        <span class="nav-link">
                            <div class="border-bottom">
                                <h6 class="font-weight-normal mb-3">Setting</h6>
                            </div>
                            <a class="nav-link" href="pages/tables/basic-table.html">
                                <span class="menu-title">Tambah User</span>
                                <i class="mdi mdi-account-plus menu-icon item float-sm-right"></i>
                            </a>
                            <button class="btn btn-block btn-lg btn-gradient-primary mt-4">Logout</button>
                        </span>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                                <i class="mdi mdi-home"></i>
                            </span> Dashboard
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span></span>Update <i class="mdi mdi-arrow-up-bold-circle-outline icon-sm text-primary align-middle"></i>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-md-4 stretch-card grid-margin">
                            <div class="card bg-gradient-danger card-img-holder text-white">
                                <div class="card-body">
                                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                                    <h4 class="font-weight-normal mb-3">Tanggal<i class="mdi mdi-clock mdi-24px float-right"></i>
                                    </h4>
                                    <h2 class="mb-5">11/12/2021 23:42</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 stretch-card grid-margin">
                            <div class="card bg-gradient-info card-img-holder text-white">
                                <div class="card-body">
                                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                                    <h4 class="font-weight-normal mb-3">RFID<i class="mdi mdi-account-card-details mdi-24px float-right"></i>
                                    </h4>
                                    <h2 class="mb-5">KDW21L0</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 stretch-card grid-margin">
                            <div class="card bg-gradient-success card-img-holder text-white">
                                <div class="card-body">
                                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                                    <h4 class="font-weight-normal mb-3">Pintu Tol<i class="mdi mdi-highway mdi-24px float-right"></i>
                                    </h4>
                                    <h2 class="mb-5">Karawang</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Recent Updates</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>RFID</th>
                                                    <th>Nama</th>
                                                    <th>Saldo Awal</th>
                                                    <th>Harga</th>
                                                    <th>Saldo Akhir</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>12/12/2021 00:36</td>
                                                    <td>2IKD3O</td>
                                                    <td>Dika</td>
                                                    <td>55000</td>
                                                    <td>5000</td>
                                                    <td>50000</td>
                                                    <td>
                                                        <label class="badge badge-gradient-success">BERHASIL</label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>12/12/2021 10:20</td>
                                                    <td>PCW21L</td>
                                                    <td>Fiki</td>
                                                    <td>15000</td>
                                                    <td>15000</td>
                                                    <td>0</td>
                                                    <td>
                                                        <label class="badge badge-gradient-warning">PENDING</label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>12/12/2021 10:28</td>
                                                    <td>CXW3KP</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>
                                                        <label class="badge badge-gradient-info">UNREGISTERED</label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>12/12/2021 10:32</td>
                                                    <td>O2DWJB</td>
                                                    <td>Elsa</td>
                                                    <td>10000</td>
                                                    <td>15000</td>
                                                    <td>10000</td>
                                                    <td>
                                                        <label class="badge badge-gradient-danger">GAGAL</label>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
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
        <script type="text/javascript" src="time/datetime.js"></script>
        <script type="text/javascript">
            window.onload = date_time('time/date_time');
        </script>
</body>

</html>