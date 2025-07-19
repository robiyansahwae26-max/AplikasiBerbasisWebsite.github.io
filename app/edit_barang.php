<?php 

include 'database.php';

extract($_POST);

$q_update_barang = mysqli_query($koneksi, "UPDATE barang SET nama_barang='". $nama_barang . "', 
    harga_barang='" . $harga_beli . "', harga_jual='" . $harga_jual . "' WHERE id_barang='".$id_barang."'");

if($q_update_barang){
    $output = [
        'kode' => 1,
        'pesan' => 'Berhasil Menyimpan Data Barang '
    ];
}else{
    $output = [
        'kode' => 0,
        'pesan' => 'Gagal Menyimpan Data Barang '
    ];
}


echo json_encode($output);

?>