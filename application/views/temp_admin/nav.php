<?php
$a = $this->session->userdata('is_login');
$foto = $a['foto'];
$nm_pengguna = $a['nm_level'];
$nama_admin = $a['nama_admin'];
?>
<section class="sidebar">
    <div class="user-panel">
        <div class="pull-left image">
            <?php if ($foto == '') { ?>
                <img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            <?php } else { ?>
                <img src="<?php echo base_url(); ?>assets/img/user/<?= $foto; ?>" class="img-circle" alt="<?= $nm_pengguna; ?>">
            <?php } ?>
                <p><?=$nama_admin;?></p>
        </div> 
        <div class="pull-left info">
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>

    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
            </span>
        </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree" id="nav">
        <li class="header">MAIN NAVIGATION</li>
        <li class="">
            <a href="<?php echo base_url(); ?>index.php/Home/admin.html">
                <i class="fa fa-dashboard"></i><span>Dashboard</span>
            </a>
        </li>
        <li class="">
            <a href="<?= base_url();?>index.php/transaksi/Trans_order.html"> <i class="fa fa-circle-thin"></i><span> Transaksi Order</span></a>
        </li>
        <li class="">
            <a href="<?= base_url();?>index.php/transaksi/Trans_pengeluaran.html"> <i class="fa fa-circle-thin"></i><span> Transaksi Pengeluaran</span></a>
        </li>
        <li class="treeview">
            <a href="#"><i class="fa fa-database"></i><span>Data Setting</span>
                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
                <li class=""><a href="<?= base_url();?>index.php/admin/Setting/set_profil.html"> <i class="fa fa-product-hunt"></i><span> Setting Profil</span></a></li>
                <li class=""><a href="<?= base_url();?>index.php/admin/Setting/set_user.html"> <i class="fa fa-user"></i><span> Setting User</span></a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#"><i class="fa fa-maxcdn"></i><span>Data Master </span>
                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
                <li class=""><a href="<?= base_url();?>index.php/admin/Master/jenis_menu.html"> <i class="fa fa-circle-thin"></i><span> Data Jenis Menu</span></a></li>
                <li class=""><a href="<?= base_url();?>index.php/admin/Master/menu.html"> <i class="fa fa-circle-thin"></i><span> Data Menu</span></a></li>
            </ul>
        </li>
        <li class=""><a href="<?= base_url();?>index.php/admin/laporan/Laporan_html.html"> <i class="fa fa-file-archive-o"></i><span> Laporan</span></a></li>
    </ul>

</section>


<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>
    $(function () {
        $('#nav a[href~="' + location.href + '"]').parents('li').addClass('active');
    });
</script>