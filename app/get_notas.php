<?php

include "database.php";
extract($_POST);

$tgl1 = $_POST['tgl1'].' 00:00:00';
$tgl2 = $_POST['tgl2'].' 00:00:00';
$query_nota = mysqli_query($koneksi, "SELECT * FROM nota 
WHERE tgl BETWEEN '$tgl1' AND '$tgl2'
ORDER BY id_nota DESC");

$no = 1;

$data_nota = [];
foreach($query_nota as $key){
    $row = [];
    $row = [
        'id_nota' => $nota['id_nota'],
        'tgl_keluar' => $nota['tgl_keluar'],
        'nama_pembeli' => $nota['nama_pembeli'],
        'total' => number_format($nota['total']),
        'bayar' => number_format($nota['bayar']),
        'kembalian' => number_format($nota['kembalian']),
    ]; 
    $data_nota[] = $row; 
}

echo json_encode($output);

?>