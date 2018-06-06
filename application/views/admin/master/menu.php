<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = $this->session->userdata('is_login');
$msg = $this->session->flashdata('msg');
$tipe = $this->session->flashdata('tipe');
$lambang = 'fa-check';
$notify = 'Sukses!';
echo $javasc
?>   
<div class="box box-warning">
    <div class="box-header with-border">
        <button class="btn btn-warning btn-sm" data-toggle="modal" 
                data-target="#aksi_menu"
                data-ket="tambah"><i class="fa fa-plus"></i> Menu</button>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table class="tabel_3 table table-bordered table-hover" id="tabel_menu" width="100%">
                <thead>
                    <tr>
                        <th class="text-center"  width="15%">Kode Menu</th>
                        <th class="text-center"  >Nama Menu</th>
                        <th class="text-center"  >Satuan Menu</th>
                        <th class="text-center"  >Harga Menu</th>
                        <th class="text-center"  width="5%">Diskon</th>
                        <th class="text-center"  > Total Harga</th>
                        <th class="text-center"  width="5%"> Foto</th>
                        <th class="text-center"  width="8%"><i class="fa fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($get_dataMenu as $row) {
                        $ttl_harga = @($row->harga_menu - ($row->harga_menu * $row->diskon_menu / 100));
                        ?>
                        <tr>
                            <td class="text-center"><?= $row->kode_menu; ?></td>
                            <td class=""><?= $row->nama_menu; ?></td>
                            <td class="text-center"><?= $row->satuan; ?></td>
                            <td class="text-right"><span class="pull-left">Rp. </span><?= number_format($row->harga_menu, 2, ',', '.'); ?></td>
                            <td class="text-center"><?= $row->diskon_menu; ?> %</td>
                            <td class="text-right"><span class="pull-left">Rp. </span><?= number_format($ttl_harga, 2, ',', '.'); ?></td>
                            <td class="text-center no-padding">
                                <a href="<?= base_url(); ?>index.php/admin/Master/lihat_foto_menu.html?kode=<?= $row->kode_menu; ?>" class="btn btn-flat btn-sm btn-block btn-default">Lihat Foto</a>
                            </td>
                            <td class="no-padding text-center">
                                <div class="btn-group">
                                    <button class="btn btn-flat btn-sm btn-warning" data-toggle="modal" 
                                            data-target="#aksi_menu"
                                            data-kode_menu="<?= $row->kode_menu; ?>"
                                            data-nama_menu="<?= $row->nama_menu; ?>"
                                            data-harga_menu="<?= $row->harga_menu; ?>"
                                            data-diskon_menu="<?= $row->diskon_menu; ?>"
                                            data-satuan="<?= $row->satuan; ?>"
                                            data-id_jenis_menu="<?= $row->id_jenis_menu; ?>"
                                            data-ket="edit"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-flat btn-sm btn-danger" data-toggle="modal" 
                                            data-target="#aksi_menu"
                                            data-kode_menu="<?= $row->kode_menu; ?>"
                                            data-satuan="<?= $row->satuan; ?>"
                                            data-nama_menu="<?= $row->nama_menu; ?>"
                                            data-harga_menu="<?= $row->harga_menu; ?>"
                                            data-diskon_menu="<?= $row->diskon_menu; ?>"
                                            data-id_jenis_menu="<?= $row->id_jenis_menu; ?>"
                                            data-ket="hapus"><i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div><!-- /.box -->     
<div class="modal fade" id="aksi_menu" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gray-active">
                <button type="button" class="close" id="close-modal"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"></h4>
            </div>
            <form id="form_menu">
                <div class="modal-body">
                    <div class="hapusHidden">
                        <h4 class="alert bg-gray-active">Apakah Andayakin akan menghapus menu ini . . ??</h4>
                    </div>
                    <!--
                                        <div class="hapusHiddenGagal">
                                            <h4 class="alert bg-gray">Anda Tidak bisa menghapus ini karena masih terkait dengan data menu!!<br></h4>
                                            <note>*) Silahkan kosongkan terlebih dahulu menu pada jenis menu ini.</note>
                                        </div>-->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <!--<label>Jenis Menu</label>-->
                                <select name='id_jenis_menu' id='id_jenis_menu' required class="form-control btn btn-default select2 id_jenis_menu" style="width: 100%">
                                    <option value=''> Pilih Jenis Menu</option>
                                    <?php
                                    foreach ($get_dataJenisMenu as $row_jnd) {
                                        echo"<option value='$row_jnd->id'>$row_jnd->nama_jenis_menu</option>";
                                    }
                                    ?>
                                </select>
                                <note>Jenis Menu</note>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon bg-gray-active">Kode Menu</span>
                                        <input type='number' name='kode_menu' minlength="6" maxlength="6" class="form-control kode_menu" id='kode_menu' autofocus="true" placeholder="Kode Menu">
                                    </div>
                                </div>
                                <note>*) Harus 6 Digit Angka</note>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="form-group">
                                <label>Nama Menu</label>
                                <input type='text' name='nama_menu' class="form-control nama_menu" id='nama_menu'  placeholder="Nama Menu">
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Satuan Menu</label>
                                <input type='text' name='satuan' class="form-control satuan" id='satuan'  placeholder="Satuan Menu">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon bg-gray-active">Rp.</span>
                                    <input type="text" class="form-control text-right uang harga_menu" id='harga_menu' name="harga_menu"  placeholder="Harga Menu">
                                    <span class="input-group-addon bg-gray-active">,00</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon bg-gray-active">Diskon</span>
                                    <input type="number" class="form-control text-center diskon_menu" id='diskon_menu' name="diskon_menu"  placeholder="Diskon">
                                    <span class="input-group-addon bg-gray-active">%</span>
                                </div>
                            </div>
                        </div>
                        <input type='hidden' name='ket' class="form-control ket" id='ket' placeholder="ket">
                    </div>
                </div>
                <div class="modal-footer bg-gray-active">
                    <div class="submit"></div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>

    $('#aksi_menu').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var ket = button.data('ket');
        var nama_menu = button.data('nama_menu');
        var kode_menu = button.data('kode_menu');
        var harga_menu = button.data('harga_menu');
        var diskon_menu = button.data('diskon_menu');
        var id_jenis_menu = button.data('id_jenis_menu');
        var satuan = button.data('satuan');
//        var harga_menu = n.toLocale(undefined);
        var modal = $(this);
        modal.find('.modal-body input.ket').val(ket);
        if (ket == 'tambah') {
            modal.find('#editlabel').html('<b>Form Tambah Menu</b>');
            modal.find('.modal-body select.id_jenis_menu').val('').removeAttr('readonly', 'readonly');
            modal.find('.modal-body input.id').val('').removeAttr('readonly', 'readonly');
            modal.find('.modal-body input.kode_menu').val('').removeAttr('readonly', 'readonly');
            modal.find('.modal-body input.harga_menu').val('').removeAttr('readonly', 'readonly');
            modal.find('.modal-body input.diskon_menu').val('').removeAttr('readonly', 'readonly');
            modal.find('.modal-body input.nama_menu').val('').removeAttr('readonly', 'readonly');
            modal.find('.modal-body input.satuan').val('').removeAttr('readonly', 'readonly');
            modal.find('.hapusHidden').addClass('hidden');
//            modal.find('.hapusHiddenGagal').addClass('hidden');
            modal.find('.submit').html('<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Simpan</button>');
        } else if (ket == 'edit') {
            modal.find('#editlabel').html('<b>Form Edit Menu</b>');
            modal.find('.modal-body select.id_jenis_menu').val(id_jenis_menu).change();
            modal.find('.modal-body input.kode_menu').val(kode_menu).attr('readonly', 'readonly');
            modal.find('.modal-body input.harga_menu').val(harga_menu).removeAttr('readonly', 'readonly');
            modal.find('.modal-body input.satuan').val(satuan).removeAttr('readonly', 'readonly');
            modal.find('.modal-body input.diskon_menu').val(diskon_menu).removeAttr('readonly', 'readonly');
            modal.find('.modal-body input.nama_menu').val(nama_menu).removeAttr('readonly', 'readonly');
            modal.find('.submit').html('<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Edit</button>');
            modal.find('.hapusHidden').addClass('hidden');
        } else if (ket == 'hapus') {
            modal.find('#editlabel').html('<b>Form Hapus Menu</b>');
            modal.find('.modal-body select.id_jenis_menu').val(id_jenis_menu).change().attr('disabled', 'disabled');
            modal.find('.modal-body input.kode_menu').val(kode_menu).attr('readonly', 'readonly');
            modal.find('.modal-body input.harga_menu').val(harga_menu).attr('readonly', 'readonly');
            modal.find('.modal-body input.satuan').val(satuan).attr('readonly', 'readonly');
            modal.find('.modal-body input.diskon_menu').val(diskon_menu).attr('readonly', 'readonly');
            modal.find('.modal-body input.nama_menu').val(nama_menu).attr('readonly', 'readonly');
            modal.find('.submit').html('<button type="submit" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus</button>');
            modal.find('.hapusHidden').removeClass('hidden');
        }
    });
    $('#form_menu').validate({
        rules: {
            kode_menu: {required: true},
            nama_menu: {required: true},
            harga_menu: {required: true}
        },
        submitHandler: function (form) {
            var ket = $('#ket').val();
            if (ket == 'tambah') {
                var url_form = '<?= base_url(); ?>index.php/admin/Master/insertMenu';
            } else if (ket == 'edit') {
                var url_form = '<?= base_url(); ?>index.php/admin/Master/updateMenu';
            } else if (ket == 'hapus') {
                var url_form = '<?= base_url(); ?>index.php/admin/Master/deleteMenu';
            }
            $.ajax({
                type: 'POST',
                url: url_form,
                data: $(form).serialize(),
                success: function (data) {
                    if (data == 'true') {
                        sukses(ket);
                    } else {
                        gagal(ket);
                    }
                }
            });
        }
    });

    function lihat_menu(id_jenis_menu) {
        $.ajax({
            type: 'POST',
            url: '<?= base_url(); ?>index.php/admin/Master/lihat_menu',
            data: {id_jenis_menu: id_jenis_menu},
            beforeSend: function () {
                $('#load').show();
            },
            success: function (respont) {
                $('#load').hide();
                $('#lihatMenu').html(respont);
            }
        });
    }

    function sukses(ket) {
        $("#notivs").html('<div class="alert alert-success alert-dismissable animated fadeIn" id="notification"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="icon fa fa-check"></i> Sukses!</h4> Berhasil di ' + ket + '. </div>');
        $('#close-modal').trigger("click");
        setTimeout(function () {
            location.reload();
            $('#notification').fadeOut('slow');
        }, 2000);
    }
    function gagal(ket) {
        $("#notivs").html('<div class="alert alert-danger alert-dismissible" id="alert-notification"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Peringatan!</h4> Gagal Di Simpan. </div>');
        $('#close-modal').trigger("click");
        setTimeout(function () {
            $('#alert-notification').fadeOut('slow');
        }, 2000);
    }

</script>