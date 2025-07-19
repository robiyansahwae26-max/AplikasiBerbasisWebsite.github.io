<?php 

include "database.php";

$start = $_POST['xBegin'];
$end = $_POST['xEnd'];
$query_nota = mysqli_query($koneksi, "SELECT * FROM nota WHERE tgl_keluar BETWEEN '$start 00:00:00' AND '$end 23:59:59' ");
if($query_nota){
    $no = 1;
    $data = '<table id="penjualan" class="table table-bordered table-hover table-sm responsive" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>No. Nota</th>
                    <th>Pembeli</th>
                    <th>Total</th>
                    <th>--</th>
                </tr>
            </thead>
            <tbody>';
    while($nota = mysqli_fetch_array($query_nota)){
        $data .= '<tr>
                <td class="text-center">'.$no.'</td>
                <td>'.$nota['tgl_keluar'].'</td>
                <td><a href="#preview" data-toggle="modal" data-id="'.$nota['id_nota'].'" class="btn-detail">'.$nota['id_nota'].'</a></td>
                <td>'.$nota['nama_pembeli'].'</td>
                <td>'.number_format($nota['total']).'</td>
                <td class="text-center">
                        <a href="http://localhost/Plastik/index.php?page=edit_nota&id_nota='.$nota['id_nota'].'" class="badge badge-info">
                            Edit
                        </a>
                        <a href="#" class="badge badge-danger btn-hapus" data-id="'.$nota['id_nota'].'">Hapus</a>
                    </td>
                </tr>';
    $no++;
    }

    $data .= '</tbody></table>';
    
    $output = [
        'status' => 1,
        'data' => $data,
        'periode' => date('d F Y',strtotime($start)).' - '.date('d F Y',strtotime($end)),
    ];
}else{
    $output = [
        'status' => 0,
        'data' => '<h2 class="text-center">Data Tidak Ditemukan</h2>',
        'periode' => date('d F Y',strtotime($start)).' - '.date('d F Y',strtotime($end)),
    ];
}


echo json_encode($output);
?>