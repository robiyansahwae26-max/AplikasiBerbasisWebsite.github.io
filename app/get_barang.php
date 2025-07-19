<?php

include "database.php";
extract($_POST);

$query_barang = mysqli_query($koneksi,"SELECT * FROM barang WHERE id_barang='$id_barang'");

$output = mysqli_fetch_array($query_barang);

echo json_encode($output);

?>