<div class="row">
    <div class="col-12">
        <div class="card card-danger card-outline">
            <div class="card-header d-flex justify-content-between">

                <div class="d-flex">
                    <h3 class="card-title ">
                        Data Penjualan
                    </h3>
                </div>
                <div class="ml-auto d-flex">
                    <h6 class="btn bg-gradient-info dropdown-toggle" id="reportrange">
                        <b id="periode"></b>
                    </h6>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <div class="row">

                    <div class="col-lg-12">
                        <div class="row">

                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box shadow">
                                    <div class="info-box-content text-center">
                                        <span class="info-box-text">Total Penjualan <br />Hari Ini</span>
                                        <span class="info-box-number">
                                            <?php 
                                            $total1 = total('Hari');
                                            echo ($total1 != 0) ? 'Rp '.number_format($total1) : 0;
                                            ?>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box shadow">
                                    <div class="info-box-content text-center">
                                        <span class="info-box-text">Total Penjualan <br />Bulan Ini</span>
                                        <span class="info-box-number">
                                            <?php 
                                            $total2 = total('Bulan');
                                            echo ($total2 != 0) ? 'Rp '.number_format($total2) : 0;
                                            ?>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box shadow">
                                    <div class="info-box-content text-center">
                                        <span class="info-box-text">Total Penjualan <br />Tahun Ini</span>
                                        <span class="info-box-number">
                                            <?php 
                                            $total3 = total('Tahun');
                                            echo ($total3 != 0) ? 'Rp '.number_format($total3) : 0;
                                            ?>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box shadow">
                                    <div class="info-box-content text-center">
                                        <span class="info-box-text">Total Penjualan <br />Selama Ini</span>
                                        <span class="info-box-number">
                                            <?php 
                                            $total4 = total('Selama');
                                            echo ($total4 != 0) ? 'Rp '.number_format($total4) : 0;
                                            ?>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive" id="tbl-utama"></div>
                    </div>
                </div>

                <div class="modal fade " id="preview" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-danger modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">

                                <b id='h_id_nota'></b>

                                <button type="button" class="btn btn-close " data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body overflow-auto" id='nota'>

                                <table width="100%" cellspacing='0'>
                                    <thead>
                                        <tr>
                                            <th>ID Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Total Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data_penjualan">

                                    </tbody>
                                </table>

                            </div>
                            <div class="modal-footer">
                                <a href="#" target="_blank" id="btn_print_nota" class="btn btn-primary">Print Nota
                                    (kecil)</a>
                                <a href="#" target="_blank" id="btn_print_faktur" class="btn btn-primary">Print Nota
                                    (besar)</a>
                                <button type="button" class="btn btn-danger bg-gradient-danger ml-auto "
                                    data-dismiss="modal">Keluar</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Page specific script -->
                <script>
                var base_url = window.location.origin + '/Plastik';

                var start = moment().subtract(29, 'days');
                var end = moment();


                function req_ajx(url, params) {
                    $.ajax({
                        url: base_url + url,
                        type: 'POST',
                        data: params,
                        dataType: 'json',
                        success: function(res) {
                            window.location.replace(base_url +
                                "/index.php?page=penjualan");
                        }
                    });
                }

                $(document).on('click', '.btn-hapus', function() {
                    if (confirm('Apakah anda yakin akan menghapus nota ini ? ')) {
                        let id = $(this).data('id');
                        let data_input = {
                            id_nota: id,
                        }
                        req_ajx('/app/hapus_nota.php', data_input);
                    }
                });

                $(document).on('click', '.btn-detail', function() {
                    $('#data_penjualan').empty();
                    let id = $(this).data('id');
                    let data_input = {
                        id_nota: id,
                    }

                    $.ajax({
                        url: base_url + '/app/get_nota.php',
                        type: 'POST',
                        data: data_input,
                        dataType: 'json',
                        success: function(res) {
                            $('#btn_print_nota').attr('href', base_url +
                                '/print_nota.php?id_nota=' + res
                                .id_nota);
                            $('#btn_print_faktur').attr('href', base_url +
                                '/print_faktur.php?id_nota=' +
                                res
                                .id_nota);

                            $('#h_id_nota').html(res.tgl_keluar + ' : No.Nota ' + res.id_nota +
                                ' <br> <b>' + res
                                .nama_pembeli + '</b>');

                            $.each(res.data_nota, function(i, row) {
                                $('#data_penjualan').append(`
                                    <tr>
                                        <td>` + row.id_barang + `</td>
                                        <td>` + row.nama_barang + `</td>
                                        <td>` + row.harga_jual + `</td>
                                        <td>` + row.jml_keluar + `</td>
                                        <td>` + row.total_harga + `</td>
                                    </tr>
                                `);
                            });
                        }
                    });
                });

                $(function() {

                    function get_data(start, end) {
                        $.ajax({
                            url: base_url + '/app/get_penjualan.php',
                            type: 'POST',
                            data: {
                                xBegin: start,
                                xEnd: end
                            },
                            dataType: 'json',
                            success: function(res) {
                                $('#periode').html(res.periode);
                                $('#tbl-utama').empty();
                                if (res.status == 1) {
                                    $('#tbl-utama').append(res.data);
                                    get_datatable();
                                } else {
                                    $('#tbl-utama').append(res.data);
                                }
                            }
                        });
                    }

                    function cb(start, end) {
                        let tgl1 = start.format('YYYY-MM-DD');
                        let tgl2 = end.format('YYYY-MM-DD');
                        get_data(tgl1, tgl2);
                    }

                    $('#reportrange').daterangepicker({
                        startDate: start,
                        endDate: end,
                        ranges: {
                            'Today': [moment(), moment()],
                            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                            'This Month': [moment().startOf('month'), moment().endOf('month')],
                            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment()
                                .subtract(1, 'month').endOf('month')
                            ]
                        }
                    }, cb);

                    cb(start, end);

                    function get_datatable() {
                        $(document).find('#penjualan').DataTable({
                            "autoWidth": true,
                            "responsive": true,
                            // "buttons": ["excel", "pdf", "print", "colvis"],
                            dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
                                "<'row'<'col-sm-12'tr>>" +
                                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                            buttons: [{
                                    extend: 'pageLength',
                                    text: 'Tampilkan',
                                    className: 'btn-sm btn-info',
                                },
                                {
                                    extend: 'pdf',
                                    className: 'btn-sm btn-danger',
                                    text: '<i class="fa fa-file-pdf"></i>&nbsp; PDF',
                                },
                            ],
                        });
                    }

                });
                </script>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>