<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = $this->session->userdata('is_login');
$msg = $this->session->flashdata('msg');
$tipe = $this->session->flashdata('tipe');
$lambang = 'fa-check';
$notify = 'Sukses!';
echo $javasc
?>   

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
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-gray-active">
            <button type="button" class="close" id="close-modal_profil"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="editlabel">Form Edit Profil</h4>
        </div>
        <form id="tambah_urusanx" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/admin/Setting/update_profilAdmin.html" method="POST">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group">
                            <label>Username</label>
                            <input type='text' name='username' class="form-control" value="<?= $row_us->username; ?>" required autofocus="true" placeholder="Username" >
                        </div>
                    </div>
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group">
                            <label>Password Lama</label>
                            <input type='password' name='password_lama' class="form-control" id="pass_lama" required placeholder="Password Lama" >
                            <input type='hidden' name='password' class="form-control" id="password" value="<?= $row_us->password; ?>">
                        </div>
                    </div>
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group">
                            <label>Password Baru</label>
                            <input type='password' name='password_baru' class="form-control"  placeholder="Password Baru"  required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type='text' name='nama' class="form-control" value="<?= $row_us->nama_admin; ?>"  required placeholder="Nama Admin" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No Telpon</label>
                            <input type='text' name='no_telpon' class="form-control" value="<?= $row_us->no_telpon; ?>" placeholder="No Telpon" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type='email' name='email' class="form-control" value="<?= $row_us->email; ?>" placeholder="email" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <center>
                            <label>Foto Profil</label>
                            <div id='tampilimg'>
                                <img src='<?= base_url() ?>assets/img/user/<?= $row_us->foto; ?>' class="img-responsive" width="40%">
                            </div>
                            <div class="hidden_file hidden">
                                <input type="file" name="upload_image" id="upload_image" class="form-control bg-gray-light">
                            </div>
                            <hr>
                            <button type='button' onclick='gantiimg()' class='btn'>Ganti</button>
                            <button type='button'  onclick='batalimg()' class='btn'>Batal</button>
                        </center>
                        <input type="hidden" name="url" value="<?= $url; ?>" class="form-control">
                        <input type='hidden' name='img' class="form-control" value="<?= $row_us->foto; ?>" />
                    </div>
                    <div class="col-md-6">
                        <center>
                            <div id="uploaded_image"></div>
                        </center>
                    </div>
                </div>
                <input type="hidden" class="form-control id" name="id" value="<?= $row_us->id; ?>">
            </div>
            <div class="modal-footer bg-gray-active">
                <button type="submit" id="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </form>
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

<script>
    $(document).ready(function () {
        $('#pass_lama').after('<span class="status_password"></span>').css('margin-right', '10px');
        $('#pass_lama').keyup(function () {
            $(this).css({'border': '1px solid #ccc', 'background': 'none'});
        });

        $('#pass_lama').change(function (e) {
            var pass_lama = $(this).val();
            var password = $("#password").val();
            if (pass_lama == password) {
                $('.status_password').html('<img src="<?php echo base_url(); ?>/assets/img/true.png"><b style="color:green;"> Password Lama diterima</b>');
                $('#submit').removeAttr("disabled", "disabled");

            } else {
                $('.status_password').html('<img src="<?php echo base_url(); ?>/assets/img/false.png"><b style="color:red;"> Password Lama Anda Tidak Falid</b>');
                $('#pass_lama').css({'border': '3px solid #f00', 'background': 'yellow'});
                $("#submit").attr("disabled", "disabled");
            }
        });
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

<script>
    function gantiimg() {
        $("#tampilimg").addClass('hidden');
        $(".hidden_file").removeClass('hidden');
    }
    function batalimg() {
        $("#tampilimg").removeClass('hidden');
        $(".hidden_file").addClass('hidden');
        $("#tampilimg").html("<img src='<?= base_url() ?>assets/img/user/<?= $row_us->foto; ?>' class='img-responsive' width='40%'>")
    }
</script>