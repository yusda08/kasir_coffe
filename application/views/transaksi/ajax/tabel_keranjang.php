<div class="box">
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="tabel_menu" width="100%">
                <thead>
                    <tr>
                        <th class="text-center"  width="5%">No</th>
                        <th class="text-center"  >Nama Menu</th>
                        <th class="text-center"  >Harga Menu</th>
                        <th class="text-center"  width="20%">Qty</th>
                        <th class="text-center"  >Sub Pembayaran</th>
                        <th class="text-center"  width="3%"><i class="fa fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $ttl_pemb = 0;
                    foreach ($get_transTemporaryDetail as $row) {
                        $sub_ttl = $row->harga_menu * $row->qty;
                        $ttl_pemb += $sub_ttl;
                        ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td class=""><?= $row->nama_menu; ?></td>
                            <td class="text-right"><span class="pull-left">Rp. </span><?= number_format($row->harga_menu, 2, ',', '.'); ?></td>
                            <td class="text-center">
                                <div class="input-group text-center">
                                    <input class="form-control" type="hidden" id="qty_<?= $row->kode_menu; ?>" value="<?= $row->qty; ?>">
                                    <button onclick="editQty($('#qty_<?= $row->kode_menu; ?>').val(), 'min', '<?= $row->kode_order; ?>', '<?= $row->kode_menu; ?>')" 
                                            class="btn btn-warning btn-xs btn-flat" type="button">
                                        <i class="fa fa-minus"></i></button>

                                    <?= $row->qty . " " . $row->satuan; ?>
                                    <button onclick="editQty($('#qty_<?= $row->kode_menu; ?>').val(), 'plus', '<?= $row->kode_order; ?>', '<?= $row->kode_menu; ?>')" 
                                            type="button" class="btn btn-success btn-xs btn-flat">
                                        <i class="fa fa-plus"></i></button>

                                </div>

                            </td>
                            <td class="text-right"><span class="pull-left">Rp. </span><?= number_format($sub_ttl, 2, ',', '.'); ?></td>
                            <td class="text-center no-padding">
                                <button onclick="hapusKeranjang('<?= $row->kode_order; ?>', '<?= $row->kode_menu; ?>')" 
                                        type="button" class="btn btn-danger btn-block btn-flat">
                                    <i class="fa fa-trash"></i></button>

                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <?php
                    $ppn = $row_pro->ppn;
                    $ttl_ppn = @($ttl_pemb*$ppn/100);
                    ?>
                    <tr>
                        <th class="text-center"  colspan="4">Pajak (PPN) <?= $row_pro->ppn;?> %</th>
                        <th class="text-right"  ><div class="ttlHarga"><?= number_format($ttl_ppn, 2, ',', '.'); ?></div></th>
                        <th class="text-center"  width="8%"></th>
                    </tr>
                    <tr>
                        <th class="text-center"  colspan="4">T o t a l</th>
                        <th class="text-right"  ><div class="ttlHarga"><span class="pull-left">Rp. </span><?= number_format($ttl_pemb+$ttl_ppn, 2, ',', '.'); ?></div></th>
                        <th class="text-center"  width="8%"></th>
                    </tr>
                    <tr>
                        <th class="text-center"  colspan="4">Kembalian</th>
                        <th class="text-right"  ><div class="kembalian"></div></th>
                        <th class="text-center"  width="8%"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <input type="hidden" class="form-control" name="ttl_pembayaran" id="ttl_pembayaran" value="<?= $ttl_pemb+$ttl_ppn; ?>">
    </div>
</div>  
<script>
    function editQty(qty, aksi, kode_order, kode_menu) {
        var posting = $.post('<?= base_url() ?>index.php/transaksi/Trans_order/updateQty', {
            kode_order: kode_order,
            kode_menu: kode_menu,
            aksi: aksi,
            qty: qty
        });
        posting.done(function (data) {
            if (data == 'true') {
                load_tbl_menu(kode_order);
            } else {
                alert('Gagal');
            }
        });
    }
    function hapusKeranjang(kode_order, kode_menu) {
        var posting = $.post('<?= base_url() ?>index.php/transaksi/Trans_order/deleteKeranjang', {
            kode_order: kode_order,
            kode_menu: kode_menu
        });
        posting.done(function (data) {
            if (data == 'true') {
                load_tbl_menu(kode_order);
            } else {
                alert('Gagal');
            }
        });
    }
</script>