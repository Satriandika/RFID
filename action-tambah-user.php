<?php

    require "koneksidb.php";

    $username            = $_POST['username'];
    $data = query("SELECT * FROM tb_user WHERE username='$username'")[0];

    if ($data == 0 && $username ) {
        if ($_POST['submit'] == "Submit") {
            $username          = $_POST['username'];
            $password           = $_POST['password'];
    
            //Masukan data ke Table
            $input = "INSERT INTO tb_user (username,password) VALUES ('" . $username . "', '" . $password . "')";
            $res = $koneksi->query($input);

            if($res) {
                header("Location: page-tambah-user.php?pesan=berhasil");
            } else {
                header("Location: page-tambah-user.php?pesan=gagal");        
            }
        }
    } else {
        header("Location: page-tambah-user.php?pesan=gagal");
    }
?>