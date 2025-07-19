<?php 

$stok = [];
include "database.php";
extract($_POST);

$query_stok_barang = mysqli_query($koneksi, "SELECT a.id_barang, nama_barang, harga_barang, 
    harga_jual, sum(jml_pemasukan) - 
    (CASE WHEN (SELECT id_barang FROM pengeluaran WHERE id_barang=b.id_barang GROUP BY id_barang) IS NULL 
                                                THEN 0 ELSE 
                                                (SELECT sum(jml_keluar) FROM pengeluaran WHERE id_barang=b.id_barang)
                                                END)  as stok, 
    
    tgl_masuk 
    FROM pemasukan AS a
    INNER JOIN barang AS b ON a.id_barang = b.id_barang
    WHERE a.id_barang = $id_barang GROUP BY id_barang");
$no = 1;
$nama_barang = null;
while($barang = mysqli_fetch_array($query_stok_barang)){
    $row = [];
    $row = [
        'id_barang' => $barang['id_barang'],
        'nama_barang' => $barang['nama_barang'],
        'harga_beli' => number_format($barang['harga_barang']),
        'harga_jual' =>$barang['harga_jual'],
        'jml_pemasukan' => $barang['stok'],
        'tgl_masuk' => $barang['tgl_masuk'],
    ]; 
    $stok[] = $row; 
    $nama_barang = $barang['nama_barang'];
    $no++;
}

$output = [
    'kode' => 1,
    'nama_barang' => $nama_barang,
    'data_stok' => $stok,
    'total_row' => $no
];

echo json_encode($output);

?>
