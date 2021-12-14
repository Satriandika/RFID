<?php

require "koneksidb.php";
require("const-error-map.php");

$rfid            = $_POST['rfid'];
$data = query("SELECT * FROM tb_daftarrfid WHERE rfid='$rfid'")[0];

if ($data > 0) {
    if ($_POST['Submit'] == "Submit") {
        $rfid            = $_POST['rfid'];
        $topup           = $_POST['topup'];

        // query saldo
        $saldo = queryfirst("select * from tb_daftarrfid where rfid like '$rfid'")['saldo'];
        $saldoakhir = $saldo + $topup;

        //Masukan data ke Table
        $input = "UPDATE tb_daftarrfid SET saldo = $saldoakhir WHERE rfid ='$rfid'";
        $koneksi->query($input);

        //Masukkan ke data log
        $sqlsave = "INSERT INTO tb_simpan (tanggal, rfid, saldoawal, saldoakhir, harga, tol, status_transaksi) VALUES(current_timestamp(), '$rfid', $saldo, $saldoakhir, NULL, NULL, '".TOPUP."');";
        if (!$koneksi->query($sqlsave)) throw new Exception("fail save log");


        header("Location: page-topup.php?pesan=berhasil");
    }
} else {
    header("Location: page-topup.php?pesan=gagal");
}
