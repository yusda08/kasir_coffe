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
        <div class="row">
            <div class="col-md-3">
                <label>Pilih Level User :</label>
            </div>        
            <div class="col-md-4">
                <?php
                $level_user = isset($_REQUEST['level_user']) ? $_REQUEST['level_user'] : "";
                ?>
                <form name='flevel_user' method='get' >
                    <select name='level_user' class="btn btn-default select2" style="width: 100%"  onchange='document.flevel_user.submit();'>
                        <option value=''> Pilih Level User</option>
                        <?php
                        foreach ($get_refLevelUser as $row_lvl) {
                            echo"<option value='$row_lvl->id'";
                            if ($level_user == $row_lvl->id)
                                echo" selected";
                            echo">$row_lvl->level_user</option>";
                        }
                        ?>
                    </select> 
                </form>
            </div>
        </div>
    </div><!-- /.box-header -->
    <?php
    if (!empty($level_user)) {
        if ($level_user == 1) {
            $nm_level = 'Admin';
        } else {
            $nm_level = 'Kasir';
        }
        if ($jml_lvl_user_1 == 1) {
            $att = 'disabled';
        } else {
            $att = '';
        }
        ?>
        <div class="box-body">
            <button class="btn btn-warning btn-sm" data-toggle="modal" 
                    data-target="#aksi_user"
                    data-level_user="<?= $level_user; ?>"
                    data-ket="tambah"><i class="fa fa-plus"></i> <?= $nm_level; ?></button>
            <div class="table-responsive">
                <table class="tabel_3 table table-hover table-bordered" width="100%">
                    <thead >
                        <tr>
                            <th width="5%">No</th>
                            <th >Username</th>
                            <th >Password</th>
                            <th >Nama Pengguna</th>
                            <th >No Telpon</th>
                            <th >Email</th>
                            <th >Status</th>
                            <th  width="5%"><i class="fa fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($get_setUser as $row) {
                            if ($row->level_user == $level_user) {
                                ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $row->username; ?></td>
                                    <td><?= $row->password; ?></td>
                                    <td><?= $row->nama_admin; ?></td>
                                    <td><?= $row->no_telpon; ?></td>
                                    <td><?= $row->email; ?></td>
                                    <td class="text-center no-padding">
                                        <?php
                                        if ($row->is_active == 1) {
                                            if ($level_user == 1) {
                                                ?>
                                                <button <?= $att; ?> class="btn btn-sm btn-success btn-flat btn-block" onclick="aksi_kunci('<?= $row->id; ?>', 'kunci');"><i class="fa fa-unlock"></i> Aktif</button>
                                            <?php } else { ?>                                            
                                                <button class="btn btn-sm btn-success btn-flat btn-block" onclick="aksi_kunci('<?= $row->id; ?>', 'kunci');"><i class="fa fa-unlock"></i> Aktif</button>

                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <button class="btn btn-sm btn-danger btn-flat btn-block" onclick="aksi_kunci('<?= $row->id; ?>', 'buka');"><i class="fa fa-lock"></i> Tidak Aktif</button>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center no-padding">
                                        <?php if ($level_user == 1) { ?>
                                            <button <?= $att; ?> title="hapus user" class="btn btn-flat btn-sm btn-danger" data-toggle="modal" 
                                                                 data-target="#aksi_user" 
                                                                 data-username ="<?= $row->username; ?>"
                                                                 data-email="<?= $row->email; ?>"
                                                                 data-password="<?= $row->password; ?>"
                                                                 data-no_telpon="<?= $row->no_telpon; ?>"
                                                                 data-nama_admin="<?= $row->nama_admin; ?>"
                                                                 data-id ="<?= $row->id; ?>"
                                                                 data-ket="hapus" ><i class="fa fa-trash"></i></button>
                                                             <?php } else { ?>
                                            <button title="hapus user" class="btn btn-flat btn-sm btn-danger" data-toggle="modal" 
                                                    data-target="#aksi_user" 
                                                    data-username ="<?= $row->username; ?>"
                                                                 data-email="<?= $row->email; ?>"
                                                                 data-password="<?= $row->password; ?>"
                                                                 data-no_telpon="<?= $row->no_telpon; ?>"
                                                                 data-nama_admin="<?= $row->nama_admin; ?>"
                                                                 data-id ="<?= $row->id; ?>"
                                                    data-ket="hapus" ><i class="fa fa-trash"></i></button>
                                                <?php } ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } ?><!-- /.box-body -->
</div><!-- /.box -->     
<div class="modal fade" id="aksi_user" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gray-active">
                <button type="button" class="close" id="close-modal"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"></h4>
            </div>
            <form id="form_user">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Pengguna</label>
                                <input type='text' name='nama_admin' class="form-control nama_admin" id='nama_admin' autofocus="true" placeholder="Nama Pengguna">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input type='text' name='username' class="form-control username" id='username' placeholder="Username">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control email" name="email" id="email" placeholder="Alamat Email">
                            </div>
                        </div>
                        <div class="pass">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control  password" name="password" id='password' placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>No Telpon</label>
                                <input type="tel" class="form-control no_telpon" id='no_telpon' name="no_telpon" placeholder="No Telpon">
                            </div>
                            <input type='hidden' name='id' class="form-control id" id='id' placeholder="id">
                            <input type='hidden' name='ket' class="form-control ket" id='ket' placeholder="ket">
                            <input type='hidden' name='level_user' class="form-control level_user" id='level_user' placeholder="level_user">
                        </div>

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
    $('#aksi_user').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var level_user = button.data('level_user');
        var ket = button.data('ket');
        var username = button.data('username');
        var no_telpon = button.data('no_telpon');
        var email = button.data('email');
        var nama_admin = button.data('nama_admin');
        var password = button.data('password');
        var id = button.data('id');
        var modal = $(this);
        modal.find('.modal-body input.level_user').val(level_user);
        modal.find('.modal-body input.ket').val(ket);
        if (ket == 'tambah') {
            modal.find('#editlabel').html('<b>Form Tambah Data User</b>');
            modal.find('.modal-body input.nama_admin').val('').removeAttr('readonly', 'readonly');
            modal.find('.modal-body input.username').val('').removeAttr('readonly', 'readonly');
            modal.find('.modal-body input.no_telpon').val('').removeAttr('readonly', 'readonly');
            modal.find('.modal-body input.email').val('').removeAttr('readonly', 'readonly');
            modal.find('.modal-body input.id').val('');
            modal.find('.pass').removeClass('hidden');
            modal.find('.submit').html('<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Simpan</button>');
        } else if (ket == 'hapus') {
            modal.find('#editlabel').html('<b>Form Hapus Data User</b>');
            modal.find('.modal-body input.password').val(password).attr('readonly', 'readonly');
            modal.find('.modal-body input.nama_admin').val(nama_admin).attr('readonly', 'readonly');
            modal.find('.modal-body input.username').val(username).attr('readonly', 'readonly');
            modal.find('.modal-body input.no_telpon').val(no_telpon).attr('readonly', 'readonly');
            modal.find('.modal-body input.email').val(email).attr('readonly', 'readonly');
            modal.find('.modal-body input.id').val(id);
            modal.find('.pass').addClass('hidden');
            modal.find('.submit').html('<button type="submit" class="btn btn-danger btn-flat"><i class="fa fa-save"></i> Hapus</button>');
        }
    });
    $('#form_user').validate({
        rules: {
            nama_admin: {required: true},
            email: {required: true, email: true},
            username: {required: true},
            password: {required: true},
            no_telpon: {required: true},
            level_user: {required: true}
        },
        submitHandler: function (form) {
            var ket = $('#ket').val();
            if (ket == 'tambah') {
                var url_form = '<?= base_url(); ?>index.php/admin/Setting/insertUser';
            }else if (ket == 'hapus') {
                var url_form = '<?= base_url(); ?>index.php/admin/Setting/deleteUser';
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
    function aksi_kunci(id, ket) {
        var url_form = '<?= base_url(); ?>index.php/admin/Setting/updateKunci';
        $.ajax({
            type: 'POST',
            url: url_form,
            data: {id: id, ket: ket},
            success: function (data) {
                if (data == 'true') {
                    sukses(ket);
                } else {
                    gagal(ket);
                }
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