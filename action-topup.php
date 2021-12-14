<?php

    require "koneksidb.php";

    $rfid            = $_POST['rfid'];
    $data = query("SELECT * FROM tb_daftarrfid WHERE rfid='$rfid'")[0];

    if ($data > 0) {
        if ($_POST['Submit'] == "Submit") {
            $rfid            = $_POST['rfid'];
            $saldo           = $_POST['saldo'];

            //Masukan data ke Table
            $input = "UPDATE tb_daftarrfid SET saldo = saldo + '$saldo' WHERE rfid ='$rfid'";
            $koneksi->query($input);

            header("Location: page-topup.php?pesan=berhasil");
        }
    } else {
        header("Location: page-topup.php?pesan=gagal");
    }
?>