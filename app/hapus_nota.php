<?php 

include "database.php";
extract($_POST);
$q_hapus_pengeluaran = mysqli_query($koneksi, "DELETE FROM pengeluaran WHERE id_nota='" . $id_nota . "'");
$q_hapus_nota = mysqli_query($koneksi, "DELETE FROM nota WHERE id_nota='" . $id_nota . "'");

if($q_hapus_nota){
    $output = [
        'kode' => 1,
        'pesan' => 'Berhasil Menghapus Data Nota'
    ];
}else{
    $output = [
        'kode' => 0,
        'pesan' => 'Gagal Menghapus Data Nota'
    ];
}

echo json_encode($output);

?>