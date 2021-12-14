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
            <a class="nav-link border-bottom" href="page-dashboard.php">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="page-log-data.php">
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