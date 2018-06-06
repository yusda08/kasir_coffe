<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>PT. .....</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/select2/dist/css/select2.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <style>
            #notiv{
                width: 50%;
                position: absolute;
                z-index: 999;
                top: 10px;
                right: 10px;
            }

            #panel, #flip {
                padding: 5px;
                text-align: center;
                border: solid 1px #c3c3c3;
                background-color: #e5eecc;
                color: #000000;
            }

            .custom-body {
                background-image: url('<?php echo base_url(); ?>assets/img/background4.jpg') !important; 
                background-size: auto;
                -webkit-background-size: 100% 100%;
                background-repeat : no-repeat;
                background-attachment:fixed ; 

            }
            #panel {
                padding: 5px;
                display: none;
            }
            .login{
                padding-top: 0px;
                margin-top:0px; 
            }
            .bag {
                background-color:rgba(255,255,255,0.8);
            }
            .register-box {
                margin: 7% auto;
                width: 100%;
                margin-top: 5%;
            }
        </style>
    </head>
    <?php
    $msg = $this->session->flashdata('msg');
    $tipe = $this->session->flashdata('tipe');
    $lambang = 'fa-check';
    $notify = 'Sukses!';
    ?>
    <body class="hold-transition fixed login-page custom-body login">
        <div class="container" >
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
            </div><div class="row">
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
                <div class="register-box">
                    <div class="col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading ">
                                <center>
                                    <img src="<?= base_url(); ?>assets/img/logo_hwi.png" class="img-responsive">
                                </center>
                                <h4 class="login-box-msg"> DC DA-527 BARABAI</h4>
                            </div>
                            <div class="panel-body bag">
                                <a href="<?= base_url(); ?>index.php/login" class="btn btn-warning btn-flat"><i class="fa fa-backward"></i> Kembali Ke Login</a>    
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading ">
                                <h4 class="login-box-msg"> Form Register :</h4>
                            </div>
                            <form method="POST" action="<?php echo base_url(); ?>index.php/Login/aksiRegister" enctype="multipart/form-data">
                                <div class="panel-body">
                                    <div id="get-notified"></div>
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback">
                                            <label>Username</label>
                                            <input type="text" name='username' id='username' class="form-control" placeholder="Username" required>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label>Nama</label>
                                            <input type="text" id='nama' name='nama' class="form-control" placeholder="Nama Pengguna" required>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label>Email</label>
                                            <input type="email" id='email' name='email' class="form-control" placeholder="Email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label>No. Telpon</label>
                                            <input type="tel" id='no_telpon' name='no_telpon' class="form-control" placeholder="Nomor Telpon" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label>Kode Pos</label>
                                            <input type="tel" id='kode_pos' name='kode_pos' class="form-control" placeholder="Kode Pos" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label>Pilih Provinsi</label>
                                            <select name="provinsi" class="form-control select2" style="width: 100%;" id="provinsi" required>
                                                <option value=''>--Pilih Provinsi---</option>
                                                <?php foreach ($provinsi as $prov) { ?>
                                                    <option value='<?php echo $prov->id ?>' data-id_prov='<?php echo $prov->id ?>' ><?php echo $prov->nama; ?></option>
                                                <?php } ?>
                                            </select>   
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label>Kabupaten</label>
                                            <select name="kabupaten" class="form-control select2" style="width: 100%;" id="kabupaten" required>
                                                <option value=''>--Pilih Kabupaten---</option>
                                            </select>   
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label>Kecamatan</label>
                                            <select name="kecamatan" class="form-control select2"  style="width: 100%;" id="kecamatan" required>
                                                <option value=''>--Pilih Kecamatan---</option>
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label>Alamat</label>
                                            <textarea id='alamat' name='alamat' class="form-control" placeholder="Alamat" required></textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="member" value="0" onclick="bukaMember()"> Sebagai Member</label>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div id="hidden" class="hidden">
                                                <div class="form-group has-feedback">
                                                    <!--<label>ID Member</label>-->
                                                    <input type="text" id='id_member' name='id_member' class="form-control" placeholder="ID MEMBER">
                                                    <input type="hidden" id='url' name='url' class="form-control" value="<?=$url;?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Foto :</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="file" name='foto' class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer bg-info">
                                    <button type="submit" class="btn btn-success btn-flat">Daftar</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.login-box-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/jquery-validation/src/localization/messages_id.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script type="text/javascript">
                                                            $(function () {
                                                                $(".select2").select2();
                                                            });
                                                            function bukaMember() {
                                                                var member = $('#member').val();
                                                                if (member == 0) {
                                                                    $('#hidden').removeClass('hidden');
                                                                    $('#member').val(parseInt(member) + 1);
                                                                } else {
                                                                    $('#hidden').addClass('hidden');
                                                                    $('#member').val(parseInt(member) - 1);
                                                                }
                                                            }
                                                            ;

                                                            $("#provinsi").change(function () {
                                                                var id_prov = $("#provinsi").find('option:selected').data('id_prov');
                                                                var url = "<?php echo base_url(); ?>index.php/login/add_kabupaten/" + id_prov;
                                                                $('#kabupaten').load(url);
                                                                return false;
                                                            });
                                                            $("#kabupaten").change(function () {
                                                                var id_kab = $("#kabupaten").find('option:selected').data('id_kab');
                                                                var url = "<?php echo base_url(); ?>index.php/login/add_kecamatan/" + id_kab;
                                                                $('#kecamatan').load(url);
                                                                return false;
                                                            });

    //                                                        $("#form-regiter").validate({
    //                                                            rules: {
    //                                                                username: {required: true},
    //                                                                nama: {required: true},
    //                                                                email: {required: true},
    //                                                                no_telpon: {required: true},
    //                                                                alamat: {required: true},
    //                                                                provinsi: {required: true},
    //                                                                kabupaten: {required: true},
    //                                                                kecamatan: {required: true},
    //                                                            },
    //                                                            submitHandler: function (form) {
    //                                                                $.ajax({
    //                                                                    type: "POST",
    //                                                                    url: "<?php echo base_url(); ?>index.php/Login/validasi",
    //                                                                    data: $(form).serialize(),
    //                                                                    success: function (msg) {
    //                                                                        if (msg == "true") {
    //                                                                            $("#get-notified").html('<div class="alert alert-success alert-dismissable animated fadeIn"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="icon fa fa-check"></i> Sukses!</h4> Berhasil Masuk. </div>');
    //                                                                            setTimeout(function () {
    //                                                                                location.reload();
    //                                                                            }, 2000);
    //                                                                        } else {
    //                                                                            $("#get-notified").html('<div class="alert alert-danger alert-dismissible" id="alert-notification"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Peringatan!</h4> Username dan Password Salah. </div>');
    //                                                                            setTimeout(function () {
    //                                                                                $('#alert-notification').fadeOut('slow');
    //                                                                            }, 2000);
    //                                                                        }
    //                                                                    }
    //                                                                });
    //                                                            }
    //                                                        });
    </script>

</body>
</html>
