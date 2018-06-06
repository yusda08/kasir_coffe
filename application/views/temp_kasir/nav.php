<?php
$a = $this->session->userdata('is_login');
$nama = strtoupper($a['nm_level']);
$id = $a['id'];
$foto = $a['foto'];
$level = $a['level_user'];
$nm_admin = $a['nama_admin'];
?>

<div class="navbar-header">
    <a href="<?= base_url(); ?>index.php/home/kasir.html" class="navbar-brand"><b><?= $row_pro->nama; ?></b></a>
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
        <i class="fa fa-bars"></i>
    </button>
</div>

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
    <ul class="nav navbar-nav">
        <li class="bag" ><a style="color: #000;" href="<?= base_url(); ?>index.php/home/kasir.html">Baranda</a></li>
        <li class="">''</li>
        <li class="bag" ><a style="color: #000;" href="<?= base_url(); ?>index.php/transaksi/Trans_order/tambah_transaksi.html?kode_order=<?= $kode_order; ?>"><i class="fa fa-plus"></i> Order</a></li>
        <li class="">''</li>
        <li class="bag" ><a style="color: #000;" href="<?= base_url(); ?>index.php/transaksi/Trans_pengeluaran.html"><i class="fa fa-plus"></i> Pegeluaran</a></li>
        <!--            <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                      </ul>
                    </li>-->
    </ul>
</div>
<!-- /.navbar-collapse -->
<!-- Navbar Right Menu -->
<div class="navbar-custom-menu bg-gray">
    <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php if (empty($foto)) { ?>
                    <img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                <?php } else { ?>
                    <img src="<?php echo base_url(); ?>assets/img/user/<?= $foto; ?>" class="user-image" alt="<?= $nama; ?>">
                <?php } ?>
                <span class="hidden-xs"><?=$nm_admin;?></span>
            </a>
            <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header bg-gray">
                    
                    <?php if (empty($foto)) { ?>
                    <img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                <?php } else { ?>
                    <img src="<?php echo base_url(); ?>assets/img/user/<?= $foto; ?>" class="img-circle" alt="<?= $nama; ?>">
                <?php } ?>
                    <!--<img src="../../dist/img/user2-160x160.jpg"  alt="User Image">-->

                    <p>
                        <?=$nm_admin;?>
                        <!--<small>Member since Nov. 2012</small>-->
                    </p>
                </li>

                <li class="user-footer">
                    <div class="pull-left">
                        <a href="<?=base_url();?>index.php/admin/Setting/edit_profil.html?id_user=<?=$id;?>" class="btn btn-success btn-flat">Profil</a>
                    </div>
                    <div class="pull-right">
                        <a href="<?=base_url();?>index.php/Login/logout.html" class="btn btn-danger btn-flat">Sign out</a>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
</div>