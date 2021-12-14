<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once("koneksidb.php");
$data = query("SELECT * FROM tb_monitoring")[0];

?>

<!DOCTYPE html>
<html>

<head>
    <title> </title>
</head>

<body>

    <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Tanggal<i class="mdi mdi-clock mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?= $data["tanggal"]; ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">RFID<i class="mdi mdi-account-card-details mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?= $data["rfid"]; ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Pintu Tol<i class="mdi mdi-highway mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?= $data["idtol"]; ?></h2>
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
                                    <th>Nama Tol</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $datatampil = mysqli_query($koneksi, "SELECT *, a.rfid as rfid from tb_simpan a left join tb_daftarrfid b on a.rfid = b.rfid ORDER BY no DESC limit 5");
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
        </div>
    </div>

</body>

</html>