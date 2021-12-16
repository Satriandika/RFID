<?php
require "koneksidb.php";	

// sql to delete a record
$sql = "DELETE FROM tb_simpan";

if ($koneksi->query($sql) === TRUE) {
  header("location:index.php");
} else {
  echo "Error deleting record: " . $koneksi->error;
}

$koneksi->close();
// mengalihkan ke halaman index.php
header("location:page-log-data.php?pesan=berhasil");
?>