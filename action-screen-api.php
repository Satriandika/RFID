<?php

require "koneksidb.php";
require "const-error-map.php";

// get api
$status_gerbang		= $_GET["status_gerbang"];
$message		    = $_GET["message"];

date_default_timezone_set('Asia/Jakarta');
$tgl = date("Y-m-d G:i:s");

if($status_gerbang && $message) {
    $sql = "UPDATE tb_screen SET status_gerbang='$status_gerbang', message='$message'";
    var_dump($sql);
    $res = $koneksi->query($sql);
}


//MENJADIKAN JSON DATA
$result = json_encode(null);
echo $result;
