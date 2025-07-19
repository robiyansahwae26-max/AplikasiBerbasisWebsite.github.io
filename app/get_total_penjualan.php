<?php 

// extract($_POST);

    function total($jenis){
        include "database.php";
        $qry1 = "SELECT CASE WHEN sum(total) IS NULL THEN 0 ELSE sum(total) END as total FROM nota ";
        $ayna = date('Y-m-d');
        if($jenis == 'Tahun'){
            $tgl1 = date('Y');
            $query = $qry1." WHERE tgl_keluar >= '$tgl1-01-01 00:00:00' AND tgl_keluar <= '$ayna 23:59:59'";
        }
        else if($jenis=='Bulan'){
            $tgl1 = ('Y-m');
            $query = $qry1." WHERE tgl_keluar >= '$tgl1-01 00:00:00' AND tgl_keluar <= '$ayna 23:59:59'";
        }
        else if($jenis=='Hari'){
            $query = $qry1." WHERE tgl_keluar >= '$ayna 00:00:00' AND tgl_keluar <= '$ayna 23:59:59'";
        }else{
            $query = $qry1;
        }
        $query = mysqli_query($koneksi,$query);

        $hasil = mysqli_fetch_array($query)['total'];
        return $hasil;
    }

 ?>