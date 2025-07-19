<?php 

include 'database.php';
extract($_POST);
$q_insert_barang = mysqli_query($koneksi, "INSERT INTO barang (nama_barang, harga_barang, harga_jual) 
    VALUES('". $nama_barang . "','" . $harga_beli . "','" . $harga_jual . "'); ");

$id_barang = mysqli_query($koneksi,"SELECT LAST_INSERT_ID() as id;");
$id_barang = mysqli_fetch_array($id_barang)['id'];

$q_insert_stok = mysqli_query($koneksi, "INSERT INTO pemasukan(id_barang,jml_pemasukan,tgl_masuk,username) 
    VALUES('". $id_barang . "','" . $jml_stok . "','" . $tgl_masuk . "','admin');");

if($q_insert_stok && $q_insert_barang){
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