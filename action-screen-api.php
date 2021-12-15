<?php

require "koneksidb.php";
require "const-error-map.php";

// get api
$status_gerbang		= $_GET["status_gerbang"];
$message		    = $_GET["message"];

date_default_timezone_set('Asia/Jakarta');
$tgl = date("Y-m-d G:i:s");

if($status_gerbang && $message) {
    $res = $koneksi->query("UPDATE tb_monitoring SET status_gerbang = '$status_gerbang', message = '$message'");
}


//MENJADIKAN JSON DATA
$result = [];
echo $result;
