<?php

require "koneksidb.php";
require "const-error-map.php";

// get api
$rfid		= $_GET["rfid"];
$idtol		= $_GET["tol"];

date_default_timezone_set('Asia/Jakarta');
$tgl = date("Y-m-d G:i:s");

// inisiasi
$status_transaksi = BERHASIL;
$saldoakhir = 0;
$harga = 0;

// Calculate saldo
// get harga
$sqlstring = "SELECT * FROM tb_tol where idtol LIKE '$idtol'";
$tbtol = queryfirst($sqlstring);

if($tbtol && $tbtol["harga"]) {
	$harga = $tbtol["harga"];
} else {
	$status_transaksi = TOL_NOT_FOUND;
}

// get saldo
$saldo = queryfirst("select * from tb_daftarrfid where rfid like '$rfid'")['saldo'] ?? 0;

// calculate saldo
if ($saldo) {
	$saldoakhir = $saldo - $harga;
	if ($saldoakhir < 0) {
		$status_transaksi = SALDO_KURANG;
		$saldoakhir = $saldo;
	}
}

// QUERY DAFTARRFID
$data = queryfirst("SELECT * FROM tb_daftarrfid WHERE tb_daftarrfid.rfid='$rfid'");
if(!$data) {
	$data = [];
	$status_transaksi = RFID_NOT_FOUND;
}

//UPDATE DATA REALTIME PADA TABEL tb_monitoring
$sql      = "UPDATE tb_monitoring SET tanggal	= '$tgl', rfid	= '$rfid', idtol = '$idtol', status_transaksi = '$status_transaksi'";
$koneksi->query($sql);

//INSERT DATA REALTIME PADA TABEL tb_save	
$sqlsave = "INSERT INTO tb_simpan (tanggal, rfid, saldoawal, saldoakhir, harga, tol, status_transaksi) 
VALUES (current_timestamp(), '$rfid', $saldo, $saldoakhir, $harga, '$idtol', '$status_transaksi');";
$koneksi->query($sqlsave);
//update saldo daftarrfid
if ($status_transaksi == BERHASIL) {
	$sqlsave = "update tb_daftarrfid set saldo = $saldoakhir where rfid = '$rfid'";
	$koneksi->query($sqlsave);
}

//MENJADIKAN JSON DATA
$res["tanggal"] = $tgl;
$res["harga"] = $harga;
$res["saldo"] = $saldoakhir;
$res["status_transaksi"] = $status_transaksi;
$res["nama"] = $data["nama"] ?? null;
$result = json_encode($res);
echo $result;
