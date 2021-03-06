<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['status'] != "login") {
    header("location:index.php?pesan=belum_login");
}
$username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html>

<head>
    <title> </title>
</head>

<body>

    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="page-dashboard.php"><img src="assets/images/delameta2.svg" alt="logo" /></a>
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
                                <p class="mb-1 text-black"><?= $username ?></p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                            <!-- <a class="dropdown-item" href="page-log-data.php">
                                    <i class="mdi mdi-cached mr-2 text-success"></i> Activity Log </a> -->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="action-logout.php">
                                <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
                        </div>
                    </li>
        </div>
        <script type="text/javascript" src="time/datetime.js"></script>
        <script type="text/javascript">
            window.onload = date_time('time/date_time');
        </script>
    </nav>


</body>

</html>