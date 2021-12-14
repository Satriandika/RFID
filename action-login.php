<?php 
// mengaktifkan session pada php
session_start();
 
// menghubungkan php dengan koneksi database
include 'koneksidb.php';
 
// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];
 
 
// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi,"select * from tb_user where username='$username' and password='$password'");

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
 
// cek apakah username dan password di temukan pada database
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);
 
    // buat session login dan username
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login";
    // alihkan ke halaman dashboard admin
    header("location:page-dashboard.php?pesan=berhasil");
 
	
}else{
	header("location:index.php?pesan=gagal");
}
 
?>