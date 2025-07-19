<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                𝒮𝐸𝐿𝒜𝑀𝒜𝒯 𝒟𝒜𝒯𝒜𝒩𝒢 𝒟𝒾 𝐿𝐼𝑀𝐵𝒜𝐻 𝒥𝒜𝒴𝒜 𝐵𝐸𝑅𝒦𝒜𝐻
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <div class="row">

                    <div class="col-6">
                        <div class="card card-info card-outline">
                            <div class="card-header">Data Barang</div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover table-sm" width="100%" id="barang">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Harga Jual</th>
                                            <th>Stok</th>
                                            <th>online</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $query_barang_ada = mysqli_query($koneksi, "SELECT 
                                            b.id_barang, nama_barang, harga_barang, b.harga_jual, 
                                            CASE WHEN sum(jml_pemasukan) IS NULL THEN 0 ELSE sum(jml_pemasukan) END as masuk,

                                            CASE WHEN (SELECT id_barang FROM pengeluaran WHERE id_barang=b.id_barang GROUP BY id_barang) IS NULL 
                                                THEN 0 ELSE 
                                                (SELECT sum(jml_keluar) FROM pengeluaran WHERE id_barang=b.id_barang GROUP BY id_barang)
                                                END as keluar

                                            FROM  barang b
                                            LEFT JOIN pemasukan pm ON b.id_barang=pm.id_barang 
                                            GROUP BY b.id_barang
                                            ");
                                            $no = 1;
                                            while($barang = mysqli_fetch_array($query_barang_ada)){
                                                $stok = $barang['masuk'] - $barang['keluar'];
                                               if($barang['masuk'] > 0){
                                        ?>
                                        <tr id='tr-stok-<?= $no; ?>'>
                                            <td><?= $barang['nama_barang'] ?></td>
                                            <td><?= $barang['harga_jual'] ?></td>
                                            <td><?= $stok ?></td>
                                            <td class="text-center">
                                                <a href="#" class='btn-info btn-sm' id="btn_add_<?= $no; ?>"
                                                    onclick="add_product(<?= $no; ?>,<?= $barang['id_barang'] ?>)">
                                                    Tambah
                                                </a>
                                            </td>
                                        </tr>

                                        <?php $no++; } } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card card-danger card-outline">
                            <div class="card-header">Keranjang</div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover table-sm" width="100%"
                                    id='tbl_keranjang'>
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Jml</th>
                                            <th class="text-center">Total Harga</th>
                                            <th class="text-center">--</th>
                                        </tr>
                                    </thead>
                                    <tbody id="keranjang"></tbody>
                                </table>
                                <div class="row mt-2">
                                    <div class="col-4">
                                        <div class="form-group row">
                                            <a href="#cekNota" class="btn btn-primary btn-sm" id="btn_hitung_total"
                                                data-toggle="modal">Hitung Total</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade " id="cekNota" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-danger modal-dialog-centered modal-md" role="document">
                            <div class="modal-content ">
                                <div class="modal-header bg-gradient-dark">
                                    <h5><?= date('Y-m-d H:i:s') ?></h5>
                                    <button type="button" class="btn btn-close text-light close_preview"
                                        data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body overflow-auto">
                                    <form method="POST">


                                        <div class="row">
                                            <table class="table table-bordered table-hover table-sm" width="100%"
                                                id='nota'>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-2"></div>
                                            <div class="col-10 justify-content-end">
                                                <div class="form-group row">
                                                    <label for="total" class="col-sm-6 col-form-label text-right">
                                                        Total</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control form-control-sm"
                                                            id="txt_total" disabled />
                                                        <input type="hidden" id="total" name="total" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="bayar" class="col-sm-6 col-form-label text-right">
                                                        Bayar</label>
                                                    <div class="col-sm-6">
                                                        <input type="number" name="bayar"
                                                            class="form-control form-control-sm" id="bayar" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="kembali" class="col-sm-6 col-form-label text-right">
                                                        Kembali</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control form-control-sm"
                                                            id="txt_kembali" disabled />
                                                        <input type="hidden" name="kembali" id="kembali" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="nama_pembeli"
                                                        class="col-sm-6 col-form-label text-right">
                                                        Nama Pembeli</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="nama_pembeli"
                                                            class="form-control form-control-sm" id="nama_pembeli" />
                                                    </div>
                                                </div>
                                                <div class="form-group row ">
                                                    <div class="col-12 text-right">
                                                        <button type="submit" class="btn btn-primary btn-block">Simpan &
                                                            Cetak
                                                            Nota</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer bg-gradient-dark ">
                                    <button type="button"
                                        class="btn btn-danger btn-sm bg-gradient-danger ml-auto close_preview"
                                        data-dismiss="modal">Keluar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <script>
                var base_url = window.location.origin + '/Plastik';

                function add_product(id, id_barang) {
                    $('#btn_add_' + id).hide();
                    // $('#tr-stok-' + id).hide();
                    let params = {
                        id_barang: id_barang
                    }

                    $.ajax({
                        url: base_url + '/app/get_stok.php',
                        type: 'POST',
                        data: params,
                        dataType: 'json',
                        success: function(res) {
                            let total_row = parseInt($('#total_row').val()) + 1;
                            $('#total_row').val(total_row);

                            $.each(res.data_stok, function(i, stok) {
                                $('#keranjang').append(`
                                        <tr id='tr-` + id + `'>
                                            <td>` + stok.nama_barang + `</td>
                                            <td><input type="hidden" name="harga[]" id="harga-` + id + `" value="` +
                                    stok
                                    .harga_jual + `"  />
                                            ` + stok.harga_jual + `</td>
                                            <td id='td-stok-` + id + `'>
                                                <input type="hidden" name="id_barang[]" id="id_barang_` + id +
                                    `" value="` + stok
                                    .id_barang + `"  />
                                                <input type="text" name="qty[]" class='get_stok' id='qty-` + id +
                                    `' style="width:90px;" data-id='` + id +
                                    `' data-stok='` + stok.jml_pemasukan + `' data-harga='` +
                                    stok.harga_jual +
                                    `' />
                                            </td>
                                            <td class='total_harga' id='total_harga-` + id + `'></td>
                                            <td class="text-center">
                                                <a href="#" class='btn-danger btn-sm' onclick='batal(` + id + `)'>
                                                    Batal
                                                </a>
                                            </td>
                                        </tr>
                                `);
                            });
                        }
                    });
                }

                function batal(no) {
                    $('#tr-' + no).remove();
                    $('#btn_add_' + no).show();
                    $('.get_stok').trigger('change');
                }



                $(document).on('click', '#btn_hitung_total', function() {
                    let total = 0;
                    var cloneTblKeranjang = $('#tbl_keranjang').html();
                    $('#nota').empty();
                    $('#nota').append($('#tbl_keranjang').html());
                    // $('#nota tbody input').attr('disabled', 'disabled');

                    $('#nota tbody tr').each(function(i) {
                        const cellValue = $(this).find("td:nth-child(4)").data('total');
                        total += parseInt(cellValue);

                        const cellQty = $(this).find("td:nth-child(3)").data('qty');
                        $(this).find("td:nth-child(3) .get_stok").val(cellQty);
                        $(this).find("td:nth-child(3) .get_stok").attr('type', 'hidden');
                        $(this).find("td:nth-child(3)").append(cellQty);

                    });
                    $('#nota').find("th:nth-child(5)").remove();
                    $('#nota').find("td:nth-child(5)").remove();

                    $('#total').val(total);
                    $('#txt_total').val(total);

                    $('#cekNota form').attr('action', base_url + '/index.php?page=tambah_nota');
                });

                $(document).on('change', '.get_stok', function() {
                    let id = $(this).data('id');
                    let harga = $(this).data('harga');
                    let stok = $(this).data('stok');
                    let input = $('#qty-' + id).val();
                    let sisa = stok - input;
                    let total_harga = null;
                    total_harga = hitung_total_harga(input, harga);

                    if (sisa < -1) {
                        $('#qty-' + id).addClass('border border-danger');
                        $('#total_harga-' + id).html('');
                        $('#txt_total').val(null);
                        $('#total').val(null);
                    } else {
                        $('#td-stok-' + id).attr('data-qty', input);
                        $('#qty-' + id).removeClass('border border-danger');
                        $('#total_harga-' + id).html(total_harga);
                        $('#total_harga-' + id).attr('data-total', total_harga);
                    }
                });

                function hitung_total_harga(jml, harga) {
                    let hasil = jml * harga
                    return hasil;
                }

                $(function() {
                    $('#total_row').val(0);
                    $('#total').val(null);

                    $('#bayar').change(function() {
                        $('#bayar').removeClass('border border-danger');
                        $('#txt_kembali').val(null);
                        $('#kembali').val(null);

                        let total = $('#total').val();
                        let bayar = $('#bayar').val();
                        let kembali = null;
                        kembali = bayar - total;
                        if (kembali >= 0) {
                            $('#txt_kembali').val(kembali);
                            $('#kembali').val(kembali);

                        } else {
                            let kembali = total - bayar;
                            $('#txt_kembali').val(kembali);
                            $('#kembali').val(kembali);
                        }
                    });

                    $('#btn_simpan').click(function() {
                        let total_row = parseInt($('#total_row').val());
                        let id_barang = [];
                        let qty = [];
                        let harga = [];
                        for (let i = 1; i <= total_row; i++) {
                            id_barang[i] = $('#id_barang_' + i).val();
                            qty[i] = $('#qty-' + i).val();
                            harga[i] = $('#harga-' + i).val();
                        };

                        let params = {
                            id_barang: id_barang,
                            qty: qty,
                            harga: harga,
                            total: $('#total').val(),
                            bayar: $('#bayar').val(),
                            kembali: $('#kembali').val(),
                            nama_pembeli: $('#nama_pembeli').val(),
                            total_row: total_row,
                        }
                        $.ajax({
                            url: base_url + '/app/tambah_nota.php',
                            type: 'POST',
                            data: params,
                            dataType: 'json',
                            success: function(res) {
                                if (res.kode == 1) {
                                    const url = base_url +
                                        '/print_nota.php?id_nota=' + res
                                        .id_nota;
                                    window.open(url, '_blank');
                                    alert(res.pesan);
                                    window.location.replace(base_url);
                                } else {
                                    alert(res.pesan);
                                }
                            }
                        });
                    });

                    $('#barang').DataTable({
                        lengthChange: false,
                        info: false,
                        "autoWidth": true,
                        "responsive": true,
                    });
                });

                function number_format(val) {
                    var options = {
                        style: 'decimal',
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 4,
                        useGrouping: true, // true untuk menggunakan pemisah ribuan
                    };
                    return val.toLocaleString('en-US', options)
                }
                </script>

            </div>
        </div>
    </div>
</div>