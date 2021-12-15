<?php
    define("BERHASIL", "1");
    define("GAGAL", "2");
    define("RFID_NOT_FOUND", "3");
    define("TOL_NOT_FOUND", "4");
    define("SALDO_KURANG", "5");
    define("TOPUP", "6");

    $map_status_transaksi = [];
    $map_status_transaksi["1"] = "Berhasil";
    $map_status_transaksi["2"] = "Gagal";
    $map_status_transaksi["3"] = "RFID tidak ditemukan";
    $map_status_transaksi["4"] = "Tol tidak ditemukan";
    $map_status_transaksi["5"] = "Saldo kurang";
    $map_status_transaksi["6"] = "Topup";

?>