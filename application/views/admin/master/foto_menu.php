<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = $this->session->userdata('is_login');
$msg = $this->session->flashdata('msg');
$tipe = $this->session->flashdata('tipe');
$lambang = 'fa-check';
$notify = 'Sukses!';
echo $javasc;
?>
<div class="row">
    <div class="col-md-12">
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
<div class="row">
    <div class="col-md-12">
        <ul class="timeline">
            <li class="time-label">
                <span class="bg-yellow-gradient">
                    <?php
                    foreach ($get_dataMenu as $row_menu) {
                        if ($row_menu->kode_menu == $kode_menu) {
                            echo "Nama Menu : " . $row_menu->nama_menu;
                        }
                    }
                    ?>
                </span>
                <span class="pull-right">
                            <a href="<?= base_url(); ?>index.php/admin/Master/menu.html" class="btn btn-danger btn-flat"><i class="fa fa-backward"></i> Kembali</a>
                        </span>
            </li>
            <li>
                <i class="fa fa-camera bg-yellow-gradient"></i>

                <div class="timeline-item">
                    <h3 class="timeline-header">
                        <form class="form-horizontal" action="<?= base_url(); ?>index.php/admin/master/insertFotoMenu" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <center>
                                        <label>Upload Foto</label>
                                        <div class="hidden_file">
                                            <input type="file" name="upload_image" id="upload_image" class="form-control bg-gray-light">
                                        </div>
                                    </center>
                                    <input type="hidden" name="kode_menu" value="<?= $kode_menu; ?>" class="form-control">
                                    <input type="hidden" name="url" value="<?= $url; ?>" class="form-control">
                                    <center>
                                        <div id="uploaded_image"></div>
                                    </center>
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                            <hr>
                            <button class="btn btn-warning btn-sm" type="submit"><i class="fa fa-save"></i> Simpan</button>
                        </form>

                    </h3>
                    <div class="timeline-body bg-gray-active">
                    <!--<div class="">-->
                        <div class="row">
                            <?php foreach ($get_dataMenuFoto as $row) { ?>
                                <div class="col-md-2 col-xs-6">
                                    <div class="box">
                                        <div class="box-body bag">
                                            <center>
                                                <a class='fancybox' data-fancybox-group='foto' href='<?= base_url(); ?>assets/img/menu/<?= $row->foto; ?>'>
                                                    <img src="<?= base_url(); ?>assets/img/menu/<?= $row->foto; ?>" alt="..." class="profile-user-img img-thumbnail img-responsive">
                                                </a>
                                            </center>
                                            <!--<p class="text-muted text-center"></p>-->
<!--                                            <ul class="list-group list-group-unbordered text-center">
                                                <li class="list-group-item">
                                                    

                                                </li>
                                            </ul>-->
                                        </div>
                                        <div class="box-footer bg-gray-light text-center">
                                            <button type="button" class="btn btn-danger btn-xs btn-flat" 
                                                            data-toggle="modal"  
                                                            data-id="<?= $row->id; ?>" 
                                                            data-foto="<?= $row->foto; ?>" 
                                                            data-target="#aksi_hapus">
                                                        <i class="fa fa-trash-o"></i> </button>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </li> 
        </ul>
    </div>
</div>
<div id="uploadimageModal" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload & Crop Image</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 text-center">
                        <div id="image_demo" style="width:350px; margin-top:30px"></div>
                    </div>
                    <div class="col-md-4" style="padding-top:30px;">
                        <!--                        <br />
                                                <br />
                                                <br/>-->
                        <button class="btn btn-success crop_image">Crop & Upload Image</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="aksi_hapus" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <button type="button" class="close" id="close-modal_barang_hapus"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel">Form Hapus Foto</h4>
            </div>
            <form class="form-horizontal" action="<?= base_url(); ?>index.php/admin/master/deleteFotoMenu" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="info_foto"></div>
                            <input type="" class="form-control id" name="id" placeholder="Nama">  
                            <input type="" class="form-control foto" name="foto" placeholder="Nama">  
                            <input type="" class="form-control url" name="url" value="<?=$url;?>">  
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-warning">
                    <button type="submit" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#aksi_hapus').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var foto = button.data('foto');
        var modal = $(this);
        modal.find('.modal-body input.id').val(id);
        modal.find('.modal-body input.foto').val(foto);
        modal.find('.modal-body #info_foto').html('<h4 class="alert bg-gray-active">Apakah Anda Yakin Menghapus Foto ini . . . ???</h4>');
    });
    
    $(document).ready(function () {

        $image_crop = $('#image_demo').croppie({
            enableExif: true,
            viewport: {
                width: 300,
                height: 300,
                type: 'square' //circle || square
            },
            boundary: {
                width: 400,
                height: 400
            }
        });

        $('#upload_image').on('change', function () {
            var reader = new FileReader();
            reader.onload = function (event) {
                $image_crop.croppie('bind', {
                    url: event.target.result
                }).then(function () {
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
            $('#uploadimageModal').modal('show');
        });

        $('.crop_image').click(function (event) {
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (response) {
//                alert(response);
                $.ajax({
                    url: "<?= base_url(); ?>index.php/admin/Setting/crop_ImgUpload",
                    type: "POST",
                    data: {"image": response},
                    success: function (data)
                    {
                        $('#uploadimageModal').modal('hide');
                        $('#uploaded_image').html(data);
//                        $('#img').val(data.nm_foto);
                        document.getElementById('upload_image').setAttribute('type', 'hidden');
                    }
                });
            })
        });

    });
</script>