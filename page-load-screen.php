<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once("koneksidb.php");
require_once("const-error-map.php");
$data = queryfirst("SELECT * from tb_screen");
$saldo = queryfirst("SELECT * FROM tb_monitoring a join tb_daftarrfid b on a.rfid = b.rfid")["saldo"] ?? "";
$color = $data["status_gerbang"] == "Ditutup" ? "bg-gradient-danger" : "bg-gradient-success"
?>

<!DOCTYPE html>
<html>

<head>
    <title> </title>
</head>

<body>

    <div class="row">
        
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card <?= $color ?> card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-1">Gate Status<i class="mdi mdi-traffic-light mdi-24px float-right"></i>
                    </h4>
                    <h3 class="mb-1"><?= $data["status_gerbang"]; ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-warning card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-1">Message<i class="mdi mdi-message-reply-text mdi-24px float-right"></i>
                    </h4>
                    <h3 class="mb-1"><?= $map_status_screen[$data["message"]] ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-warning card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-1">Saldo<i class="mdi mdi-currency-usd mdi-24px float-right"></i>
                    </h4>
                    <h3 class="mb-1"><?= $saldo ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                
            </div>
        </div>
    </div>

</body>

</html>