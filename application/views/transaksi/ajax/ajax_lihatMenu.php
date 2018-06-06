<?php
foreach ($get_dataMenuJoinFoto as $row) {
    $ttl_harga = @($row->harga_menu - ($row->harga_menu * $row->diskon_menu / 100));
    ?>
    <div class="col-md-2 col-xs-6">
        <div class="box">
            <div class="box-body " style="padding-bottom: 0px;">
                <center>
                    <?php if ($row->foto != '') { ?>
                        <a class='fancybox' data-fancybox-group='foto' href='<?= base_url(); ?>assets/img/menu/<?= $row->foto; ?>'>
                            <img src="<?= base_url(); ?>assets/img/menu/<?= $row->foto; ?>" alt="..." class="profile-user-img img-thumbnail img-responsive">
                        </a>
                    <?php } else { ?>
                        <a class='fancybox' data-fancybox-group='foto' href='<?= base_url(); ?>assets/img/keranjang.png'>
                            <img src="<?= base_url(); ?>assets/img/keranjang.png" alt="..." class="profile-user-img img-thumbnail img-responsive">
                        </a>
                    <?php } ?>
                </center>
                <p class="text-muted text-center"></p>
                <ul class="list-group list-group-unbordered text-center">
                    <li class="list-group-item no-padding max"><?= $row->nama_menu; ?></li>
                    <li class="list-group-item no-padding text-right">
                        <span class="pull-left">Rp.</span>
                        <?= number_format($ttl_harga, 2, ',', '.'); ?></li>
                </ul>
            </div>
            <div class="box-footer bg-gray text-center no-padding">
                <button type="button" class="btn bg-gray btn-sm btn-block btn-flat" onclick="simpanTrans('<?= $row->kode_menu; ?>')">
                                <i class="fa fa-plus"></i> Tambah</button>
            </div>
        </div>
    </div>
<?php } ?>
<script>
 $(document).ready(function () {
        var heights = $(".max").map(function () {
            return $(this).height();
        }).get(),
                maxHeight = Math.max.apply(null, heights);
        $(".max").height(maxHeight);
    });
</script>