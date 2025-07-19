<?php 

extract($_POST);

$id_nota = date('YmdHis');
$tgl_keluar = date('Y-m-d H:i:s');
$q_insert_nota = mysqli_query($koneksi, "INSERT INTO nota (id_nota, tgl_keluar, nama_pembeli, total, bayar, kembalian, username) 
    VALUES('". $id_nota . "','" . $tgl_keluar . "','" . $nama_pembeli . "','" . $total . "','" . $bayar . "','" . $kembali . "','admin'); ");

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


if($q_insert_nota){
    $output = 'Berhasil Menyimpan Data Nota ';
}else{
    $output ='Gagal Menyimpan Data Nota ';
}


// echo json_encode($output);

?>

<h1><?= $output ?></h1>

<hr />
<!-- Pastikan kamu sudah menyertakan Bootstrap & Font Awesome -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="d-flex flex-wrap gap-3 mt-3">

  <a href="http://localhost/Plastik/" class="btn btn-success shadow-sm">
    <i class="fas fa-home me-1"></i> KEMBALI KE HOME
  </a>

  <a href="http://localhost/Plastik/print_nota.php?id_nota=<?= $id_nota ?>" target="_blank"
     class="btn btn-info text-white shadow-sm">
    <i class="fas fa-print me-1"></i> PRINT NOTA <small>(Kecil)</small>
  </a>

  <a href="http://localhost/Plastik/print_faktur.php?id_nota=<?= $id_nota ?>" target="_blank"
     class="btn btn-dark shadow-sm">
    <i class="fas fa-file-invoice me-1"></i> PRINT FAKTUR <small>(Besar)</small>
  </a>

</div>
