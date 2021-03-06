<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['status'] != "login") {
    header("location:index.php?pesan=belum_login");
}
$username = $_SESSION["username"];
?>
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
                    <span class="font-weight-bold mb-2"><?= $username ?></span>
                    <span class="text-secondary text-small">Trainee</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link border-bottom" href="page-dashboard.php">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link border-bottom" href="page-screen.php">
                <span class="menu-title">Screen</span>
                <i class="mdi mdi-monitor-screenshot menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="page-log-data.php">
                <span class="menu-title">Log Transaksi</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="page-tambah-rfid.php">
                <span class="menu-title">Tambah Pengguna RFID</span>
                <i class="mdi mdi-account-multiple-plus menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="page-rfid-data.php">
                <span class="menu-title">Data Pengguna RFID</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="page-topup.php">
                <span class="menu-title">Menu Top Up</span>
                <i class="mdi mdi-currency-usd menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link border-bottom" href="page-data-tol.php">
                <span class="menu-title">Data Tol</span>
                <i class="mdi mdi-road menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="page-tambah-user.php">
                <span class="menu-title">Tambah User</span>
                <i class="mdi mdi-account-plus menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="page-tambah-tol.php">
                <span class="menu-title">Tambah Tol</span>
                <i class="mdi mdi-road menu-icon"></i>
            </a>
        </li>
        <li class="nav-item sidebar-actions">
            <a class="btn btn-block btn-lg btn-gradient-primary" href="action-logout.php">Logout</a>
            <span>
        </li>
    </ul>
</nav>