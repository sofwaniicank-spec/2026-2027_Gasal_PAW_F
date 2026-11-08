<?php
incude "Koneksi.php";

$query = "SELECT * FROM mahasiswa";
$result = mysqli_query($conn, $query);

while ($row "mysqli_fetch_assoc($result)){
   echo "". $row['NIM']. "" "" .$row['Nama'] . ""
      <br>";
      
