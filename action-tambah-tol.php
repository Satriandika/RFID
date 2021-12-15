<?php

require "koneksidb.php";

if ($_POST['submit'] == "Submit") {
    $idtol              = $_POST['idtol'];
    $harga              = $_POST['harga'];

    // check existing
    $res = queryfirst("SELECT * from tb_tol where idtol = '$idtol'");
    if ($idtol == '' || $res) {
        // already exist
        header("Location: page-tambah-tol.php?pesan=gagal");
    } else {
        //Masukan data ke Table
        $input = "INSERT INTO tb_tol (idtol, harga) VALUES ('$idtol', $harga)";
        $insert = ($koneksi->query($input));
    
        if (!$insert) {
            header("Location: page-tambah-tol.php?pesan=gagal");
        } else {
            header("Location: page-tambah-tol.php?pesan=berhasil");
        }
    }

}
