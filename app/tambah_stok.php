<?php 


include 'database.php';
extract($_POST);

$q_insert_stok = mysqli_query($koneksi, "INSERT INTO pemasukan(id_barang,jml_pemasukan,tgl_masuk,username) 
    VALUES('". $id_barang . "','" . $jml_stok . "','" . $tgl_stok . "','admin');");

if($q_insert_stok){
    $output = [
        'kode' => 1,
        'pesan' => 'Berhasil Menambah Stok Barang'
    ];
}else{
    $output = [
        'kode' => 0,
        'pesan' => 'Gagal Menambah Stok Barang'
    ];
}

echo json_encode($output);

?>