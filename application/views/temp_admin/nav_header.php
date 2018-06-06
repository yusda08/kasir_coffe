<?php
$a = $this->session->userdata('is_login');
$nama = strtoupper($a['nm_level']);
$id = $a['id'];
$foto = $a['foto'];
$level = $a['level_user'];
$nm_admin = $a['nama_admin'];
?>

<a href="#" class="logo">
    <span class="logo-mini">ADM</span>
    <?php echo"<span class='logo-lg'><b>" . $nama . "</b></span>"; ?>
</a>
<nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php if (empty($foto)) { ?>
                        <img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                    <?php } else { ?>
                        <img src="<?php echo base_url(); ?>assets/img/user/<?= $foto; ?>" class="user-image" alt="<?= $nama; ?>">
                    <?php } ?>
                    <span class="hidden-xs"><?= $nama; ?></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <?php if (empty($foto)) { ?>
                            <img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        <?php } else { ?>
                            <img src="<?php echo base_url(); ?>assets/img/user/<?= $foto; ?>" class="img-circle" alt="<?= $nama; ?>">
                        <?php } ?>
                            <p>
                            <?=$nm_admin;?></p>
                    </li>
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="<?=base_url();?>index.php/admin/Setting/edit_profil.html?id_user=<?=$id;?>" class="btn btn-success btn-flat">Profil</a>
                        </div>

                        <div class="pull-right">
                            <a href="<?php echo base_url(); ?>index.php/Login/logout.html" class="btn btn-danger btn-flat">Sign out</a>
                        </div>
                    </li>
                </ul>
            </li>
            <li>
            <!--<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>-->
            </li>
        </ul>
    </div>
</nav>
