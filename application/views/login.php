<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $row_pro->nama; ?></title>
        <link rel="shortcut icon" type="image/icon" href="<?php echo base_url(); ?>assets/img/<?= $row_pro->logo_cofe; ?>"/>
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
            #get-notified {
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
                background-image: url('<?php echo base_url(); ?>assets/img/background3.png') !important; 
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
            <div class="login-box">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel bag">
                            <div class="panel-heading bg-gray ">
                                <center>
                                    <img src="<?= base_url(); ?>assets/img/<?= $row_pro->logo_cofe; ?>" width="30%">
                                </center>
                                <!--<h4 class="login-box-msg"> <?= $row_pro->nama; ?></h4>-->
                            </div>
                            <div class="panel-body ">
                                <div id="get-notified"></div>
                                <form id='form-login'>
                                    <div class="form-group has-feedback">
                                        <label>Username</label>
                                        <input type="text" name='username' id='username' class="form-control" autofocus="true" placeholder="Username">
                                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label>Password</label>
                                        <input type="password" id='password' name='password' class="form-control" placeholder="Password">
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <a href="#"><u>Lupa Password</u></a>
                                        </div>
                                        <div class="col-xs-6">
                                            <span class="pull-right">
                                                <button type="submit" class="btn btn-primary btn-flat">Masuk</button>
                                            </span>
                                        </div>
                                    </div>
                                </form>
<!--                                <center>
                                    <a href="<?= base_url(); ?>index.php/HomeIndex.html" class="btn btn-warning btn-flat"><i class="fa fa-backward"></i> Kembali Ke Baranda</a>
                                </center>-->
                            </div>
                            <div class="panel-footer bg-gray">
                                <p class="text-center"><?= $row_pro->nama; ?>
                                    <br><?= $row_pro->alamat; ?>
                                    <br><?= $row_pro->no_telpon; ?>
                                <hr>
                                <center>
                                    <b>Design by Yusda Helmani, S.Kom</b>
                                <br>
                                    Copyright &copy; <?php echo date("Y"); ?>
                                </center>
                                </p>
                            </div>
                            <!-- /.login-box-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/bower_components/jquery-validation/src/localization/messages_id.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#form-login").validate({
                    rules: {
                        password: {required: true},
                        username: {required: true}
                    },
                    submitHandler: function (form) {
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>index.php/Login/validasi",
                            data: $(form).serialize(),
                            success: function (msg) {
                                if (msg == "true") {
                                    $("#get-notified").html('<div class="alert alert-success alert-dismissable animated fadeIn"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="icon fa fa-check"></i> Sukses!</h4> Berhasil Masuk. </div>');
                                    setTimeout(function () {
                                        location.reload();
                                    }, 2000);
                                } else if (msg == "false") {
                                    $("#get-notified").html('<div class="alert alert-danger alert-dismissible" id="alert-gagal"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Peringatan!</h4> Akun Anda Tidak Aktif. </div>');
                                    setTimeout(function () {
                                        $('#alert-gagal').fadeOut('slow');
                                    }, 2000);
                                } else {
                                    $("#get-notified").html('<div class="alert alert-danger alert-dismissible" id="alert-notification"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Peringatan!</h4> Username dan Password Salah. </div>');
                                    setTimeout(function () {
                                        $('#alert-notification').fadeOut('slow');
                                    }, 2000);
                                }
                            }
                        });
                    }
                });
            });
        </script>

    </body>
</html>
