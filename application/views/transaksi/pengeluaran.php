<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = $this->session->userdata('is_login');
$msg = $this->session->flashdata('msg');
$tipe = $this->session->flashdata('tipe');
$lambang = 'fa-check';
$notify = 'Sukses!';
echo $javasc
?>
<div class="box ">
    <div class="row">
        <div class="col-md-6">
            <?php
            $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            if ($tipe == 'alert-danger') {
                $lambang = 'fa-ban';
                $notify = 'Gagal!';
            }
            if ($msg) {
                ?>
                <div class="alert <?php echo $tipe; ?> alert-dismissable" id='notiv'>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa <?php echo $lambang; ?>"></i> <?php echo $notify; ?></h4>
                    <?php echo $msg; ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="box-header with-border">
        <button class="btn btn-flat btn-sm btn-success" data-toggle="modal" 
                data-target="#aksi_pengeluaran" 
                data-ket="tambah"><i class="fa fa-plus"></i> Pengeluuaran</button>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table class="tabel_3 table table-bordered table-hover" id="tabel_menu" width="100%">
                <thead>
                    <tr>
                        <th class="text-center"  width="3%">No</th>
                        <th class="text-center">Nama Belanja</th>
                        <th class="text-center"  >Nama Kasir</th>
                        <th class="text-center"  >Tanggal</th>
                        <th class="text-center"  >Harga</th>
                        <th class="text-center"  width="8%"><i class="fa fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($a['level_user'] == 1) {
                        $no = 1;
                        $total = 0;
                        foreach ($get_transPengeluaranJoinUser as $row) {
                            $total += $row->harga;
                            ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class=""><?= $row->nama_belanja; ?></td>
                                <td class=""><?= $row->nama_admin; ?></td>
                                <td class="text-center"><?= Tgl_indo::indo($row->tanggal); ?></td>
                                <td class="text-right"><span class="pull-left">Rp. </span><?= number_format($row->harga, 2, ',', '.'); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button class="btn btn-flat btn-xs btn-warning" data-toggle="modal" 
                                                data-target="#aksi_pengeluaran" 
                                                data-id="<?= $row->id; ?>" 
                                                data-harga="<?= $row->harga; ?>" 
                                                data-nama_belanja="<?= $row->nama_belanja; ?>" 
                                                data-tanggal="<?= $row->tanggal; ?>" 
                                                data-ket="edit"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-flat btn-xs btn-danger" data-toggle="modal" 
                                                data-target="#aksi_pengeluaran" 
                                                data-id="<?= $row->id; ?>" 
                                                data-harga="<?= $row->harga; ?>" 
                                                data-nama_belanja="<?= $row->nama_belanja; ?>" 
                                                data-tanggal="<?= $row->tanggal; ?>" 
                                                data-ket="hapus"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4">T O T A L</th>
                            <th class="text-right"><span class="pull-left">Rp. </span><?= number_format($total, 2, ',', '.'); ?></th>
                            <th class="text-right"></th>
                        </tr>
                    </tfoot>
                    <?php
                } elseif ($a['level_user'] == 2) {
                    $no = 1;
                    $total = 0;
                    foreach ($get_transPengeluaranJoinUser as $row) {
                        if ($a['id'] == $row->id_user) {
                            $total += $row->harga;
                            ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class=""><?= $row->nama_belanja; ?></td>
                                <td class=""><?= $row->nama_admin; ?></td>
                                <td class="text-center"><?= Tgl_indo::indo($row->tanggal); ?></td>
                                <td class="text-right"><span class="pull-left">Rp. </span><?= number_format($row->harga, 2, ',', '.'); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">

                                        <button class="btn btn-flat btn-xs btn-warning" data-toggle="modal" 
                                                data-target="#aksi_pengeluaran" 
                                                data-id="<?= $row->id; ?>" 
                                                data-harga="<?= $row->harga; ?>" 
                                                data-nama_belanja="<?= $row->nama_belanja; ?>" 
                                                data-tanggal="<?= $row->tanggal; ?>" 
                                                data-ket="edit"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-flat btn-xs btn-danger" data-toggle="modal" 
                                                data-target="#aksi_pengeluaran" 
                                                data-id="<?= $row->id; ?>" 
                                                data-harga="<?= $row->harga; ?>" 
                                                data-nama_belanja="<?= $row->nama_belanja; ?>" 
                                                data-tanggal="<?= $row->tanggal; ?>" 
                                                data-ket="hapus"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4">T O T A L</th>
                            <th class="text-right"><span class="pull-left">Rp. </span><?= number_format($total, 2, ',', '.'); ?></th>
                            <th class="text-right"></th>
                        </tr>
                    </tfoot>
                <?php } ?>
            </table>
        </div>
    </div>
</div><!-- /.box -->     
<div class="modal fade" id="aksi_pengeluaran" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gray-active">
                <button type="button" class="close" id="close-modal"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"></h4>
            </div>
            <form id="from_pengeluaran">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Belanja</label>
                                <input type='text' name='nama_belanja' class="form-control nama_belanja" id='nama_belanja'  placeholder="Nama Belanja">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Harga</label>
                            <div class="inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon bg-gray-active">Rp.</span>
                                    <input type="text" class="form-control text-right uang harga" id='harga' name="harga"  placeholder="Harga">
                                    <span class="input-group-addon bg-gray-active">,00</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type='date' name='tanggal' class="form-control tanggal" id='tanggal' value="<?= date('Y-m-d'); ?>" placeholder="tanggal">
                            </div>
                        </div>

                        <input class="form-control id_user" type="hidden" name="id_user" value="<?= $a['id']; ?>">
                        <input class="form-control ket" type="hidden" name="ket" id="ket">
                        <input class="form-control id" type="hidden" name="id" id="id">
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
    $('#aksi_pengeluaran').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var ket = button.data('ket');
        var nama_belanja = button.data('nama_belanja');
        var harga = button.data('harga');
        var tanggal = button.data('tanggal');
        var id = button.data('id');
        var modal = $(this);
        modal.find('.modal-body input.ket').val(ket);
        if (ket == 'tambah') {
            modal.find('#editlabel').html('<b>Form Tambah Pengelaran</b>');
            modal.find('.modal-body input.id').val('').removeAttr('readonly', 'readonly');
            modal.find('.modal-body input.harga').val('').removeAttr('readonly', 'readonly');
            modal.find('.modal-body input.nama_belanja').val('').removeAttr('readonly', 'readonly');
            modal.find('.hapusHidden').addClass('hidden');
            modal.find('.submit').html('<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Simpan</button>');
        } else if (ket == 'edit') {
            modal.find('#editlabel').html('<b>Form Edit Pengeluaran</b>');
            modal.find('.modal-body input.id').val(id).removeAttr('readonly', 'readonly');
            modal.find('.modal-body input.harga').val(harga).removeAttr('readonly', 'readonly');
            modal.find('.modal-body input.tanggal').val(tanggal).removeAttr('readonly', 'readonly');
            modal.find('.modal-body input.nama_belanja').val(nama_belanja).removeAttr('readonly', 'readonly');
            modal.find('.submit').html('<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Edit</button>');
            modal.find('.hapusHidden').addClass('hidden');
        } else if (ket == 'hapus') {
            modal.find('#editlabel').html('<b>Form Hapus Pengeluaran</b>');
            modal.find('.modal-body input.id').val(id).attr('readonly', 'readonly');
            modal.find('.modal-body input.harga').val(harga).attr('readonly', 'readonly');
            modal.find('.modal-body input.tanggal').val(tanggal).attr('readonly', 'readonly');
            modal.find('.modal-body input.nama_belanja').val(nama_belanja).attr('readonly', 'readonly');
            modal.find('.submit').html('<button type="submit" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus</button>');
            modal.find('.hapusHidden').removeClass('hidden');
        }
    });
    $('#from_pengeluaran').validate({
        rules: {
            nama_belanja: {required: true},
            harga: {required: true}
        },
        submitHandler: function (form) {
            var ket = $('#ket').val();
            if (ket == 'tambah') {
                var url_form = '<?= base_url(); ?>index.php/transaksi/Trans_pengeluaran/insertPengeluaran';
            } else if (ket == 'edit') {
                var url_form = '<?= base_url(); ?>index.php/transaksi/Trans_pengeluaran/updatePengeluaran';
            } else if (ket == 'hapus') {
                var url_form = '<?= base_url(); ?>index.php/transaksi/Trans_pengeluaran/deletePengeluaran';
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
