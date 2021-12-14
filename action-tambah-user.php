<?php

    require "koneksidb.php";

    $username            = $_POST['username'];
    $data = query("SELECT * FROM tb_user WHERE username='$username'")[0];

    if ($data == 0 ) {
        if ($_POST['Submit'] == "Submit") {
            $username          = $_POST['username'];
            $password           = $_POST['password'];
    
            //Masukan data ke Table
            $input = "INSERT INTO tb_user (username,password) VALUES ('" . $username . "', '" . $password . "')";
            $koneksi->query($input);

            header("Location: page-tambah-user.php?pesan=berhasil");
        }
    } else {
        header("Location: page-tambah-user.php?pesan=gagal");
    }
?>