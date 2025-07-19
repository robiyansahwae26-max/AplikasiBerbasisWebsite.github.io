<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    EDIT NOTA
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
                                            <th>--</th>
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
                                                <a href="#" class='btn-info btn-sm'
                                                    id="btn_add_<?= $barang['id_barang']; ?>"
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
                                                        <input type="hidden" name="id_nota" id="id_nota"
                                                            value="<?= $_GET['id_nota'] ?>" />

                                                        <button type="submit" class="btn btn-primary btn-block"
                                                            id="btn-save-edit">Simpan Perubahan & Cetak Nota</button>
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

                function detail_nota(id) {
                    $('#keranjang').empty();

                    let data_input = {
                        id_nota: id,
                    }

                    $.ajax({
                        url: base_url + '/app/get_nota.php',
                        type: 'POST',
                        data: data_input,
                        dataType: 'json',
                        success: function(res) {

                            $('#h_id_nota').html(res.tgl_keluar + ' : No.Nota ' + res.id_nota +
                                ' <br> <b>' + res
                                .nama_pembeli + '</b>');
                            $('#nama_pembeli').val(res.nama_pembeli);


                            $.each(res.data_nota, function(i, row) {
                                $('#keranjang').append(`
                                    <tr id='tr-` + row.id_barang + `'>
                                        <td>` + row.nama_barang + `</td>
                                        <td><input type="hidden" name="harga[]" id="harga-` + row.id_barang +
                                    `" value="` + row.harga_jual + `"  />` + row.harga_jual + `</td>
                                        <td id='td-stok-` + row.id_barang + `' data-qty='` + row.jml_keluar + `'>
                                                <input type="hidden" name="id_barang[]" id="id_barang_` + row
                                    .id_barang + `" value="` + row.id_barang + `"  />
                                                <input type="text" name="qty[]" class='get_stok' id='qty-` +
                                    row.id_barang +
                                    `' style="width:90px;" data-id='` + row.id_barang +
                                    `' data-stok='` + row.sisa_stok + `' data-harga='` +
                                    row.harga_jual +
                                    `' value="` + row.jml_keluar + `" />
                                            </td>
                                        <td class='total_harga' id='total_harga-` + row.id_barang + `' data-total='` +
                                    row.total_harga + `'>` + row
                                    .total_harga + `</td>
                                            <td class="text-center">
                                                <a href="#" class='btn-danger btn-sm' onclick='batal(` + row
                                    .id_barang + `)'>
                                                    Batal
                                                </a>
                                            </td>
                                        </tr>
                                `);
                                $('#btn_add_' + row.id_barang).hide();
                            });
                        }
                    });
                }

                function add_product(id, id_barang) {
                    $('#btn_add_' + id).hide();

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

                    $('#nota').empty();
                    $('#nota').append($('#tbl_keranjang').html());
                    // $('#nota tbody input').attr('disabled', 'disabled');

                    $('#nota tbody tr').each(function(i) {
                        let cellValue = $(this).find("td:nth-child(4)").data('total');
                        total += parseInt(cellValue);

                        let cellQty = $(this).find("td:nth-child(3)").data('qty');
                        $(this).find("td:nth-child(3) .get_stok").val(cellQty);
                        $(this).find("td:nth-child(3) .get_stok").attr('type', 'hidden');
                        $(this).find("td:nth-child(3)").append(cellQty);

                    });
                    $('#nota').find("th:nth-child(5)").remove();
                    $('#nota').find("td:nth-child(5)").remove();

                    $('#total').val(total);
                    $('#txt_total').val(total);

                    $('#cekNota form').attr('action', base_url + '/index.php?page=proses_edit_nota');
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
                    var id_nota = $('#id_nota').val();
                    $('#total_row').val(0);
                    $('#total').val(null);

                    detail_nota(id_nota);

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

                    $('#btn-save-edit').click(function() {

                        if ($('#bayar').val() == '') {
                            $('#bayar').addClass('border border-danger');
                            return false;
                        }

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
                            id_nota: id_nota,
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
                            url: base_url + '/app/edit_nota.php',
                            type: 'POST',
                            data: params,
                            dataType: 'json',
                            success: function(res) {
                                if (res.kode == 1) {
                                    const url = base_url + '/print_nota.php?id_nota=' + res
                                        .id_nota;

                                    // window.open(url, '_blank');
                                    // window.location.replace(base_url);
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