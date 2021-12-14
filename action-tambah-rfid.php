<?php

require_once("koneksidb.php");

$page_name = "page-tambah-rfid.php";

if ($_POST['submit']) {
    $rfid            = $_POST['rfid'];
    $nama            = $_POST['nama'];
    $alamat          = $_POST['alamat'];
    $telepon         = $_POST['telepon'];
    $saldo           = $_POST['saldo'];

    // check existing data
    $check = queryfirst("SELECT * FROM tb_daftarrfid where rfid = '$rfid'");
    if ($check && count($check) > 0) {
        header("Location: $page_name?pesan=gagal");
    } else {
        //Masukan data ke Table
        $input = "INSERT INTO tb_daftarrfid (rfid, nama, alamat, telepon, saldo) VALUES ('" . $rfid . "', '" . $nama . "', '" . $alamat . "', '" . $telepon . "', " . $saldo . ")";
        $insert = ($koneksi->query($input));

        if (!$insert) {
            header("Location: $page_name?pesan=gagal");
        } else {
            header("Location: $page_name?pesan=berhasil");
        }
    }
}
