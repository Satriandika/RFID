<?php

require "koneksidb.php";

if ($_POST['submit'] == "Submit") {
    $idtol              = $_POST['idtol'];
    $harga              = $_POST['harga'];

    //Masukan data ke Table
    $input = "INSERT INTO tb_tol (idtol, harga) VALUES ('$idtol', $harga)";
    $insert = ($koneksi->query($input));

    if (!$insert) {
        header("Location: page-tambah-tol.php?pesan=gagal");
    } else {
        header("Location: page-tambah-tol.php?pesan=berhasil");
    }
}
