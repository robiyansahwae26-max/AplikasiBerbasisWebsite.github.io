<?php 

include "database.php";
extract($_POST);
$q_hapus_stok = mysqli_query($koneksi, "DELETE FROM pemasukan WHERE id_barang='" . $id_barang . "'");
$q_hapus_barang = mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang='" . $id_barang . "'");

if($q_hapus_barang){
    $output = [
        'kode' => 1,
        'pesan' => 'Berhasil Menghapus Data Barang'
    ];
}else{
    $output = [
        'kode' => 0,
        'pesan' => 'Gagal Menghapus Data Barang'
    ];
}

echo json_encode($output);

?>