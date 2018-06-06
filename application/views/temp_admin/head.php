<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?=$row_pro->nama;?></title>
<link rel="shortcut icon" type="image/icon" href="<?php echo base_url(); ?>assets/img/<?=$row_pro->logo_cofe;?>"/>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!--<link rel="stylesheet" href="/resources/demos/style.css">-->

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bower_components/fancybox/jquery.fancybox.css">


<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/croppie.css" />
<style>
    thead, th{
        text-align: center;
        font-size:10pt;
        background-color: #dedede;
    };
    #notivs {
        width: 50%;
        position: absolute;
        z-index: 999;
        top: 10px;
        right: 10px;
    }
    #notiv {
        width: 50%;
        position: absolute;
        z-index: 999;
        top: 10px;
        right: 10px;
    }

    .ajax-loader {
        visibility: hidden;
        /*background-color: rgba(255,255,255,0.7);*/
        position: absolute;
        z-index: +100 !important;
        width: 100%;
        height:100%;
    }
    .bag1{background:#000;opacity:0.4;filter:alpha(opacity=40);}
    .bag2{background:rgba(0,0,0,0.4);}
    .bg {  background: #F0FFFF;}
    .bag { background-color:rgba(255,255,255,0.8);}

</style>