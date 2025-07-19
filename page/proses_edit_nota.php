<?php 

$data_nota = [];

extract($_POST);

$q_update_nota = mysqli_query($koneksi, "UPDATE nota 
    SET nama_pembeli='" . $nama_pembeli . "', total='" . $total . "', bayar='" . $bayar . "', kembalian'" . $kembali . "' 
    WHERE id_nota='". $id_nota . "'");
$q_delete_keluar = mysqli_query($koneksi,"DELETE FROM pengeluaran WHERE id_nota='".$id_nota."'");

$total_row = count($id_barang);

for ($i = 0; $i < $total_row; $i++) {
    $input_id = $id_barang[$i];
    $input_qty = $qty[$i];
    $input_harga = $harga[$i];

    if (($input_id != '') && ($input_qty != '')) {
        $total_harga = $input_qty * $input_harga;
        $q_insert_pengeluaran = mysqli_query($koneksi, "INSERT INTO pengeluaran(id_nota,id_barang,harga_jual,jml_keluar,total_harga) 
        VALUES('". $id_nota . "','". $input_id . "','" . $input_harga . "','" . $input_qty . "','" . $total_harga . "');");
        
    }
}

if($q_update_nota){
    $output = 'Berhasil Mengubah Data Nota ';
}else{
    $output ='Gagal Mengubah Data Nota ';
}

?>

<h1><?= $output ?></h1>

<hr />
<a href="http://localhost/Plastik/" class="btn btn-success">KEMBALI KE HOME</a>
<a href="http://localhost/Plastik/print_nota.php?id_nota=<?= $id_nota ?>" target="_blank" class="btn btn-primary">PRINT
    NOTA (Kecil)</a>
<a href="http://localhost/Plastik/print_faktur.php?id_nota=<?= $id_nota ?>" target="_blank"
    class="btn btn-primary">PRINT
    NOTA (Besar)</a>