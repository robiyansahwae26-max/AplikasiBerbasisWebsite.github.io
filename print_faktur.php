<?php session_start(); ?>
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
            background-color: aliceblue;
            width: 750px;
        }

        .header,
        .footer {
            width: 100%;
            position: relative;
            display: flex;
        }

        .h-kiri {
            /* position: absolute; */
            width: 50%;
            /* display: block; */
            left: 0px;
            padding-left: 5%;
        }

        .h-kanan {
            width: 50%;
            /* display: block; */
            /* position: absolute; */
            right: 0px;
        }

        .f-kiri {
            /* position: absolute; */
            width: 70%;
            /* display: block; */
            left: 0px;
            padding-left: 5%;
        }

        .f-kanan {
            width: 30%;
            /* display: block; */
            /* position: absolute; */
            right: 0px;
            padding-right: 5%;
        }

        .panjang {
            padding-top: 2px;
            padding-left: 2px;
            padding-right: 2px;
        }

        table {
            width: 90%;
            margin-left: auto;
            margin-right: auto;
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
        <div class="header">
            <div class="h-kiri">
                <p>
                    <b>Limbah Jaya Berkah</b><br>Bogor - Karadenan
                    <br /> Bogor - Jawa Barat
                    <br /> HP. 085693881066
                </p>
            </div>
            <div class="h-kanan">
                <p>

                    <font id="txt_id_nota"></font> <br />
                    <font id="txt_pembeli"></font> <br />
                    <font id="txt_tanggal"></font> <br />
                </p>
            </div>
        </div>
        <div class="panjang">
            <div>
				<br />
                <table class="table" cellspacing="0" border="1">

                    <thead>
                        <tr>
                            <th>No</th>
                            <!-- <th>ID Barang</th> -->
                            <th>Nama Barang</th>
                            <th>Qty</th>
                            <th>Harga Satuan</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id='barang'>

                    </tbody>
                    <tfoot>
                        <tr>
                            <!-- <td rowspan="3"></td> -->
                            <td colspan="4" align="right">Total : </td>
                            <td align="right" id="txt_total"></td>
                        </tr>
                        <tr>
                            <td colspan="4" align="right">Bayar :</td>
                            <td align="right" id="txt_bayar"></td>
                        </tr>
                        <tr>
                            <td colspan="4" align="right">Kembali : </td>
                            <td align="right" id="txt_kembali"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="footer">
            <div class="f-kiri">
                <br />
                <br />
                <b>TERIMA KASIH SUDAH BERBELANJA</b>
            </div>
            <div class="f-kanan">
                <br />
				<p>
					<b>Kasir</b>
                    <br />
                    <br />
                    <br />
                    <br />
                    <hr />
                    <?= $_SESSION['title'] ?>
                </p>
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
                            i = i + 1;
                            $('#barang').append(`
                                    <tr>
                                        <td align="center">` + i + `</td>
                                        <td>` + row.nama_barang + `</td>
                                        <td>` + row.jml_keluar + `</td>
                                        <td>` + row.harga_jual + `</td>
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