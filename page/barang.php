<div class="row">
    <div class="col-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    Data Stok Barang
                </h3>
            </div>

            <div class="card-body">

                <a href="#" class='btn btn-sm btn-primary' data-toggle="modal" data-target="#addProduct"
                    onclick="clean_form()">Tambah Barang</a>

                <div class="table-responsive mt-2">
                    <table id="barang" class="table table-bordered table-hover table-sm responsive" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Harga Barang</th>
                                <th>Harga Jual</th>
                                <th>Jml Pemasukan</th>
                                <th>Jml Terjual</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $query_stok_barang = mysqli_query($koneksi, "SELECT 
                            id_barang, nama_barang, harga_barang, harga_jual, 
                            (SELECT sum(jml_pemasukan) FROM pemasukan WHERE id_barang=a.id_barang) AS pemasukan,
                            (SELECT sum(jml_keluar) FROM pengeluaran WHERE id_barang=a.id_barang) AS terjual,
                            (SELECT sum(jml_pemasukan) FROM pemasukan WHERE id_barang=a.id_barang) - (SELECT sum(jml_keluar) FROM pengeluaran WHERE id_barang=a.id_barang)  AS stok
                            FROM barang AS a");
                            $no = 1;
                            while($barang = mysqli_fetch_array($query_stok_barang)){
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $barang['nama_barang'] ?></td>
                                <td><?= $barang['harga_barang'] ?></td>
                                <td><?= $barang['harga_jual'] ?></td>
                                <td><?= $barang['pemasukan'] ?></td>
                                <td><?= $barang['terjual'] ?></td>
                                <td><?= (empty($barang['terjual']))?$barang['pemasukan']:$barang['stok'] ?></td>
                                <td>
                                    <a href="#" class='badge badge-success' data-toggle="modal" data-target="#addStock"
                                        onclick="add_stok(<?= $barang['id_barang'] ?>)">
                                        Tambah Stok
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class='badge badge-secondary' data-toggle="modal" data-target="#preview"
                                        onclick="detail_barang(<?= $barang['id_barang'] ?>)">
                                        Detail
                                    </a>
                                    <a href="#" class='badge badge-info' data-toggle='modal' data-target="#editProduct"
                                        onclick="edit_barang(<?= $barang['id_barang'] ?>)">
                                        Edit
                                    </a>
                                    <a href="#" class='badge badge-danger'
                                        onclick="hapus_barang(<?= $barang['id_barang'] ?>)">
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Barang</h5>
                                <button type="button" class="btn btn-close text-dark" aria-label="Close"
                                    data-dismiss="modal">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="tgl_masuk">Tanggal</label>
                                    <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk"
                                        value='<?= date('Y-m-d') ?>' />
                                    <small id="notif_tgl_masuk" class="text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang</label>
                                    <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                        placeholder="Masukkan Nama Barang">
                                    <small id="notif_nama_barang" class="text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="harga_beli">Harga beli</label>
                                    <input type="number" class="form-control" id="harga_beli" name="harga_beli"
                                        placeholder="Masukkan Harga Barang">
                                    <small id="notif_harga_beli" class="text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="harga_jual">Harga Jual</label>
                                    <input type="number" class="form-control" id="harga_jual" name="harga_jual"
                                        placeholder="Masukkan Harga Barang">
                                    <small id="notif_harga_jual" class="text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="jml_stok">Jumlah Stok</label>
                                    <input type="number" class="form-control" id="jml_stok" name="jml_stok"
                                        placeholder="Masukkan Qty">
                                    <small id="notif_jml_stok" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn bg-gradient-danger"
                                    data-dismiss="modal">Keluar</button>
                                <button type="submit" class="btn bg-gradient-primary" id="btn_save">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="editProduct" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Form Edit Barang</h5>
                                <button type="button" class="btn btn-close text-dark" aria-label="Close"
                                    data-dismiss="modal">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang</label>
                                    <input type="text" class="form-control" id="e_nama_barang"
                                        placeholder="Masukkan Nama Barang">
                                    <small id="notif_e_nama_barang" class="text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="harga_beli">Harga beli</label>
                                    <input type="number" class="form-control" id="e_harga_beli"
                                        placeholder="Masukkan Harga Barang">
                                    <small id="notif_e_harga_beli" class="text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="harga_jual">Harga Jual</label>
                                    <input type="number" class="form-control" id="e_harga_jual"
                                        placeholder="Masukkan Harga Barang">
                                    <small id="notif_e_harga_jual" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" id="e_id_barang" />
                                <button type="button" class="btn bg-gradient-danger"
                                    data-dismiss="modal">Keluar</button>
                                <button type="submit" class="btn bg-gradient-primary" id="btn_save_edit">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="addStock" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Stok</h5>
                                <button type="button" class="btn btn-close" aria-label="Close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>ID Barang</label>
                                    <input type="text" class="form-control" id="txt_id_barang" disabled />
                                </div>
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input type="text" class="form-control" id="txt_nama_barang" disabled />
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" class="form-control" name="tgl_stok" id="tgl_stok"
                                        value='<?= date('Y-m-d') ?>' />
                                    <small class="text-danger" id="notif_tgl_stok"></small>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Stok</label>
                                    <input type="number" class="form-control" name="qty_stok" id="qty_stok"
                                        placeholder="Masukan Jumlah Stok" />
                                    <small class="text-danger" id="notif_qty_stok"></small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" id="id_barang" />
                                <button type="button" class="btn bg-gradient-danger"
                                    data-dismiss="modal">Keluar</button>
                                <button type="submit" class="btn bg-gradient-primary"
                                    id="btn_save_stock">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade " id="preview" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-danger modal-dialog-centered modal-md" role="document">
                        <div class="modal-content bg-gradient-dark">
                            <div class="modal-header">
                                <h4 id="h_nama_barang"></h4>
                                <button type="button" class="btn btn-close text-light close_preview"
                                    data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body overflow-auto" id="stok">

                            </div>
                            <div class="modal-footer ">
                                <button type="button" class="btn btn-danger bg-gradient-danger ml-auto close_preview"
                                    data-dismiss="modal">Keluar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>

<script>
var base_url = window.location.origin + '/Plastik';

function clean_form() {
    $('#addProduct input').val(null);
    $('#tgl_masuk').val('<?= date('Y-m-d') ?>');
}

function req_ajx(url, params) {
    $.ajax({
        url: base_url + url,
        type: 'POST',
        data: params,
        dataType: 'json',
        success: function(res) {
            alert(res.pesan);
            console.log(res);

            window.location.replace(base_url +
                "/index.php?page=barang");
        }
    });
}

function hapus_barang(id) {
    if (confirm('Apakah anda yakin akan menghapus data barang ?')) {
        let data_hapus = {
            id_barang: id
        }
        req_ajx('/app/hapus_barang.php', data_hapus);
    }
}

function add_stok(id) {
    $('#addStock input').val(null);
    $('#id_barang').val(id);
    $('#tgl_stok').val('<?= date('Y-m-d') ?>');

    let params = {
        id_barang: id,
    }

    $.ajax({
        url: base_url + '/app/get_barang.php',
        type: 'POST',
        data: params,
        dataType: 'json',
        success: function(res) {
            $('#txt_id_barang').val(res.id_barang);
            $('#txt_nama_barang').val(res.nama_barang);
        }
    });
}


function detail_barang(id) {
    $('#stok').empty();

    let data_input = {
        id_barang: id,
    }

    $.ajax({
        url: base_url + '/app/get_stok.php',
        type: 'POST',
        data: data_input,
        dataType: 'json',
        success: function(res) {

            $('#stok').removeAttr('style');
            if (res.total_row > 3) {
                $('#stok').attr('style', 'height: 750px;');
            }

            $('#h_nama_barang').html(res.nama_barang);

            $.each(res.data_stok, function(i, row) {
                $('#stok').append(`
                                    <div class="card bg-gradient-dark">
                                        <div class="card-body">
                                            <div class="timeline mb-0">
                                                <div class="time-label">
                                                    <span class="bg-green">` + row.tgl_masuk + `</span>
                                                </div>
                                            <div>
                                            <div class="timeline-item">
                                                <div class="timeline-body">
                                                   <h6 class="font-weight-bold mb-0">Harga Beli : Rp ` + row
                    .harga_beli + `</h6>
                                                    <h6 class="font-weight-bold mb-0">Harga Jual : Rp ` + row
                    .harga_jual + `</h6>
                                                    <h6 class="font-weight-bold mb-0">Jumlah : ` + row.jml_pemasukan + `</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`);
            });
        }
    });
}


function edit_barang(id) {
    $('#e_id_barang').val(id);
    let params = {
        id_barang: id,
    }

    $.ajax({
        url: base_url + '/app/get_barang.php',
        type: 'POST',
        data: params,
        dataType: 'json',
        success: function(res) {
            $('#e_nama_barang').val(res.nama_barang);
            $('#e_harga_beli').val(res.harga_barang);
            $('#e_harga_jual').val(res.harga_jual);
        }
    });
}

$(function() {
    $('#barang').DataTable({
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

    $('#btn_save').click(function() {
        $('#addProduct small').html('');
        $('#addProduct input').removeClass('border-danger');

        if ($('#tgl_masuk').val() == '') {
            $('#tgl_masuk').addClass('border border-danger');
            $('#notif_tgl_masuk').html('Tanggal tidak Boleh Kosong !!');
            return false;
        }

        if ($('#nama_barang').val() == '') {
            $('#nama_barang').addClass('border border-danger');
            $('#notif_nama_barang').html('Nama Barang tidak Boleh Kosong !!');
            return false;
        }

        if ($('#harga_beli').val() == '') {
            $('#harga_beli').addClass('border border-danger');
            $('#notif_harga_beli').html('Harga Beli tidak Boleh Kosong !!');
            return false;
        }

        if ($('#harga_jual').val() == '') {
            $('#harga_jual').addClass('border border-danger');
            $('#notif_harga_jual').html('Harga Jual tidak Boleh Kosong !!');
            return false;
        }

        if ($('#jml_stok').val() == '') {
            $('#jml_stok').addClass('border border-danger');
            $('#notif_jml_stok').html('Jumlah Stok tidak Boleh Kosong !!');
            return false;
        }

        let data_input = {
            nama_barang: $('#nama_barang').val(),
            harga_beli: $('#harga_beli').val(),
            harga_jual: $('#harga_jual').val(),
            tgl_masuk: $('#tgl_masuk').val(),
            jml_stok: $('#jml_stok').val(),
        }

        req_ajx('/app/tambah_barang.php', data_input);

    });

    $('#btn_save_stock').click(function() {
        $('#addStock small').html('');
        $('#addStock input').removeClass('border-danger');

        if ($('#tgl_stok').val() == '') {
            $('#tgl_stok').addClass('border border-danger');
            $('#notif_tgl_stok').html('Tanggal tidak Boleh Kosong !!');
            return false;
        }

        if ($('#qty_stok').val() == '') {
            $('#qty_stok').addClass('border border-danger');
            $('#notif_qty_stok').html('Jumlah Stok tidak Boleh Kosong !!');
            return false;
        }

        let data_input = {
            id_barang: $('#id_barang').val(),
            tgl_stok: $('#tgl_stok').val(),
            jml_stok: $('#qty_stok').val(),
        }

        req_ajx('/app/tambah_stok.php', data_input);
    });

    $('#btn_save_edit').click(function() {
        $('#editProduct small').html('');
        $('#editProduct input').removeClass('border-danger');

        if ($('#e_nama_barang').val() == '') {
            $('#e_nama_barang').addClass('border border-danger');
            $('#notif_e_nama_barang').html('Nama Barang tidak Boleh Kosong !!');
            return false;
        }

        if ($('#e_harga_beli').val() == '') {
            $('#e_harga_beli').addClass('border border-danger');
            $('#notif_e_harga_beli').html('Harga Beli tidak Boleh Kosong !!');
            return false;
        }

        if ($('#e_harga_jual').val() == '') {
            $('#e_harga_jual').addClass('border border-danger');
            $('#notif_e_harga_jual').html('Harga Jual tidak Boleh Kosong !!');
            return false;
        }

        let data_update = {
            id_barang: $('#e_id_barang').val(),
            nama_barang: $('#e_nama_barang').val(),
            harga_beli: $('#e_harga_beli').val(),
            harga_jual: $('#e_harga_jual').val(),
        }

        req_ajx('/app/edit_barang.php', data_update);

    });
});
</script>