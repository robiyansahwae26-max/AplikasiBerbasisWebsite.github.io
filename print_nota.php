<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PRINT NOTA</title>
    <!-- jQuery -->
    <script src="AdminLTE_3/plugins/jquery/jquery.min.js"></script>
    <style>
    * {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-size: 14px;
        /* font-weight: bold; */
    }

    .luar {
        position: relative;
    }

    .panjang {
        position: absolute;
        width: 250px;
        padding-top: 2px;
        padding-left: 2px;
        padding-right: 2px;
    }

    table {
        width: 100%;
    }

    .panjang table td {
        padding: 2px;
    }

    th {
        text-align: center;
    }
    </style>
</head>

<body>
    <div class="luar">
        <div class="panjang">
            <div>

                <p align='center'><b>Limbah Jaya Berkah</b><br>Bogor - Karadenan
                    <br /> Bogor - Jawa Barat
                    <br />
                    HP. 085693881066
                </p>
                <hr>
                <p>

                    <b id="txt_id_nota"></b> <br />
                    <b id="txt_pembeli"></b> <br />
                    <b id="txt_tanggal"></b> <br />
                </p>
                <hr>
                <table class="table" cellspacing="0" id='barang'></table>
                <hr>
                <table>
                    <tr>
                        <td>Total : </td>
                        <td align="right" id="txt_total"></td>
                    </tr>
                    <tr>
                        <td>Bayar :</td>
                        <td align="right" id="txt_bayar"></td>
                    </tr>
                    <tr>
                        <td>Kembali : </td>
                        <td align="right" id="txt_kembali"></td>
                    </tr>
                </table>
                <p align='center'>TERIMA KASIH SUDAH BERBELANJA</p>
                <HR>
            </div>
        </div>
    </div>

    <script>
    $(function() {
        var base_url = window.location.origin + '/Plastik';

        let params = {
            id_nota: <?= $_GET['id_nota'] ?>,
        }

        function load_data() {
            $.ajax({
                url: base_url + '/app/get_nota.php',
                type: 'POST',
                data: params,
                dataType: 'json',
                success: function(res) {


                    $.each(res.data_nota, function(i, row) {
                        $('#barang').append(`
                                    <tr><td colspan="2">` + row.nama_barang + `</td></tr>
                                    <tr>
                                        <td>` + row.jml_keluar + ` x ` + row.harga_jual + `</td>
                                        <td align="right">` + row.total_harga + `</td>
                                    </tr>`);
                    });

                    $('#txt_id_nota').html('ID Nota : ' + res.id_nota);
                    $('#txt_pembeli').html('Pembeli : ' + res.nama_pembeli);
                    $('#txt_tanggal').html('Time : ' + res.tgl_keluar);
                    $('#txt_total').html(res.total);
                    $('#txt_bayar').html(res.bayar);
                    $('#txt_kembali').html(res.kembalian);

                    window.print();
                }
            });
        }

        load_data();

    });
    </script>
</body>

</html>