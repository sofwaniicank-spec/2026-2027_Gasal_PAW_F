<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'db_mhs';

$conn = mysqli_connect($host, $username, $password, $dbname);

if(!$conn){
	die('konekasi gagal' . mysqli_connect_error($conn));

}

echo "Konekasi Berhasil";