<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = $this->session->userdata('is_login');
$msg = $this->session->flashdata('msg');
$tipe = $this->session->flashdata('tipe');
$lambang = 'fa-check';
$notify = 'Sukses!';
echo $javasc;
$nama_admin = $a['nama_admin'];
$ttl_pemb = 0;
foreach ($get_transOrderDetail as $row) {
    $sub_ttl = $row->harga_menu * $row->qty;
    $ttl_pemb += $sub_ttl;
}
$no_meja = $row_ord->no_meja;
$tanggal = $row_ord->tanggal;
$jam = $row_ord->jam;
$diskon = $row_ord->diskon;
$tunai = $row_ord->tunai;
?>   
<span class="pull-right">
    <?php if ($a['level_user'] == 1) { ?>
        <a href="<?= base_url(); ?>index.php/transaksi/Trans_order.html" 
           class="btn btn-flat btn-sm btn-danger"><i class="fa fa-backward"></i> Kembali</a>
       <?php } else { ?>
        <a href="<?= base_url(); ?>index.php/home/kasir.html" 
           class="btn btn-flat btn-sm btn-danger"><i class="fa fa-backward"></i> Kembali</a>
       <?php } ?>
</span>
<br>
<br>
<form class="form-horizontal" id="editOrder">
    <div class="row">
        <div class="col-md-5">
            <div class="box">
                <div class="box-body">
                    <table class="table no-border">
                        <tr>
                            <td width="30%">Kode Order</td>
                            <td width="5%">:</td>
                            <td><?= $kode_order; ?>
                                <input type="hidden" id="kode_order" class="form-control" name="kode_order" value="<?= $kode_order; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>No Meja</td>
                            <td>:</td>
                            <td><input type="text" class="form-control" readonly name="no_meja" required value="<?= $no_meja; ?>"><note>*) Harus di isi</note></td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td>
                                <?= Tgl_indo::indo($tanggal) . " -- " . $jam; ?>
                                <input type="hidden" class="form-control" name="tanggal" value="<?= date('Y-m-d'); ?>">
                                <input type="hidden" class="form-control" name="jam" value="<?= date('H:i:s'); ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Admin</td>
                            <td>:</td>
                            <td><?= $nama_admin; ?>
                                <input type="hidden" class="form-control" name="id_user" value="<?= $a['id']; ?>">
                                <input type="hidden" class="form-control" name="ppn" value="<?= $row_pro->ppn; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Diskon Order</td>
                            <td>:</td>
                            <td>
                                <div class="inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon bg-gray-active">Diskon</span>
                                        <input type="number" value="<?= $diskon; ?>" onkeyup="diskonOrder(this.value, $('#ttl_pembayaran').val())" class="form-control text-center diskon_order" id='diskon_order' name="diskon_order" value="0"  placeholder="Diskon">
                                        <span class="input-group-addon bg-gray-active">%</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Duit Tunai</td>
                            <td>:</td>
                            <td>
                                <div class="inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon bg-gray-active">Rp. </span>
                                        <input type="text" value="<?= $tunai; ?>" onkeyup="duitTunai(this.value, $('#ttl_pembayaran').val(), $('#diskon_order').val())" class="form-control text-right uang tunai" id='tunai' name="tunai" placeholder="Diskon">
                                        <span class="input-group-addon bg-gray-active">,00</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><button class="btn btn-block btn-flat btn-warning"><i class="fa fa-save"></i> Simpan Order</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div id="tblKeranjang">
                <div class="box">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="tabel_menu" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center"  width="5%">No</th>
                                        <th class="text-center"  >Nama Menu</th>
                                        <th class="text-center"  width="18%">Harga Menu</th>
                                        <th class="text-center"  width="20%">Qty</th>
                                        <th class="text-center"  width="23%">Sub Pembayaran</th>
                                        <th class="text-center"  width="3%"><i class="fa fa-cog"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $ttl_pemb = 0;
                                    foreach ($get_transOrderDetail as $row) {
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
                                    $ttl_ppn = @($ttl_pemb * $ppn / 100);
                                    $ttl_ppn_pem = $ttl_pemb + $ttl_ppn;
                                    ?>
                                    <tr>
                                        <th class="text-center"  colspan="4">Pajak (PPN) <?= $row_pro->ppn; ?> %</th>
                                        <th class="text-right"  ><div class="ttlHarga"><?= number_format($ttl_ppn, 2, ',', '.'); ?></div></th>
                                        <th class="text-center"  width="8%"></th>
                                    </tr>
                                    <tr>
                                        <th class="text-center"  colspan="4">T o t a l</th>
                                        <th class="text-right"  ><div class="ttlHarga"><span class="pull-left">Rp. </span><?= number_format($ttl_ppn_pem, 2, ',', '.'); ?></div></th>
                                        <th class="text-center"  width="8%"></th>
                                    </tr>
                                    <tr>
                                        <th class="text-center"  colspan="4">Kembalian</th>
                                        <th class="text-right"  ><div class="kembalian"><span class="pull-left">Rp. </span><?= number_format($tunai - $ttl_ppn_pem, 2, ',', '.'); ?></div></th>
                                        <th class="text-center"  width="8%"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <input type="hidden" class="form-control" name="ttl_pembayaran" id="ttl_pembayaran" value="<?= $ttl_ppn_pem; ?>">
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>
<div class="box">
    <div class="box-header with-border bg-gray-active">
        <?php foreach ($get_dataJenisMenu as $row_jns) { ?>
            <button class="btn btn-warning btn-sm" onclick="filter_menu('<?= $row_jns->id; ?>')"><?= $row_jns->nama_jenis_menu; ?></button>
        <?php } ?>

    </div><!-- /.box-header -->
    <div class="box-body bg-gray-light">
        <center><span id="load" style="display:none"><img src='<?= base_url(); ?>assets/img/ajax-loader.gif' ></span></center>
        <div id="filter_barang">
            <?php
            foreach ($get_dataMenuJoinFoto as $row) {
                $ttl_harga = @($row->harga_menu - ($row->harga_menu * $row->diskon_menu / 100));
                ?>
                <div class="col-md-2 col-xs-6">
                    <div class="box">
                        <div class="box-body" style="padding-bottom: 0px;">
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
        </div>
    </div>
</div><!-- /.box -->     
<div class="modal fade" id="print_order" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gray-active">
                <button type="button" class="close" id="close-modal"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"></h4>
            </div>
            <form id="form_jenis_menu">
                <div class="modal-body">
                    <div class="hapusHidden">
                        <p>Klik Print Untuk Melanjutkan memprint Faktor pembelian</p>
                        <p>Klik Kembali Untuk Kembali Ke menu Order</p>

                    </div>
                </div>
        </div>
        <div class="modal-footer bg-gray-active">
            <?php if ($a['level_user'] == 1) { ?>
                <a href="<?= base_url(); ?>index.php/transaksi/Trans_order.html" 
                   class="btn btn-flat btn-sm btn-danger"><i class="fa fa-backward"></i> Kembali</a>
<?php } else { ?>
                <a href="<?= base_url(); ?>index.php/home/kasir.html" 
                   class="btn btn-flat btn-sm btn-danger"><i class="fa fa-backward"></i> Kembali</a>
<?php } ?>
            <a target="_blank" href="<?= base_url(); ?>index.php/admin/laporan/laporan_html/cetak_strukOrder.html?kode_order=<?= $kode_order; ?>" class="btn btn-success btn-flat"><i class="fa fa-print"></i> Print</a>
        </div>
        </form>
    </div>
</div>
<script>
    $('#editOrder').validate({
        rules: {
            no_meja: {required: true},
            diskon: {required: true},
            tunai: {required: true}
        },
        submitHandler: function (form) {
            var url_form = '<?= base_url(); ?>index.php/transaksi/Trans_order/updateOrder.html';
            $.ajax({
                type: 'POST',
                url: url_form,
                data: $(form).serialize(),
                success: function (data) {
                    if (data == 'true') {
                        showModalPrint('<?= $kode_order; ?>');
                    } else {
                        alert('gagal menyimpan data');
                    }
                }
            });
        }
    });

    function showModalPrint(kode_order) {
        $('#print_order').modal('toggle');
    }

    function filter_menu(id_jenis_menu) {
        $.ajax({
            type: 'POST',
            url: '<?= base_url(); ?>index.php/transaksi/Trans_order/lihat_menu',
            data: {id_jenis_menu: id_jenis_menu},
            beforeSend: function () {
                $('#load').show();
            },
            success: function (respont) {
                $('#load').hide();
                $('#filter_barang').html(respont);
            }
        });
    }


    function simpanTrans(kode_menu) {
        var kode_order = $("#kode_order").val();
        var posting = $.post('<?= base_url() ?>index.php/transaksi/Trans_order/insertMenuTrans', {
            kode_order: kode_order,
            kode_menu: kode_menu
        });
        posting.done(function (data) {
//            $("#tblKeranjang").load(data);
            load_tbl_menu(kode_order);
//            window.location.reload();
        });
    }

    function load_tbl_menu(kode_order) {
        $('#tblKeranjang').load('<?php echo base_url(); ?>index.php/transaksi/Trans_order/ajax_tblKeranjangEdit/' + kode_order);
    }

    function sukses(ket) {
        $("#notivs").html('<div class="alert alert-success alert-dismissable animated fadeIn" id="notification"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="icon fa fa-check"></i> Sukses!</h4> Berhasil di ' + ket + '. </div>');
        $('#close-modal').trigger("click");
        setTimeout(function () {
            location.reload();
            $('#notification').fadeOut('slow');
        }, 2000);
    }
    function gagal(ket) {
        $("#notivs").html('<div class="alert alert-danger alert-dismissible" id="alert-notification"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Peringatan!</h4> Gagal Di Simpan. </div>');
        $('#close-modal').trigger("click");
        setTimeout(function () {
            $('#alert-notification').fadeOut('slow');
        }, 2000);
    }

    function diskonOrder(nil, ttl_pem) {
        if (nil == '') {
            nil = 0;
        }
        var nilai = parseFloat(nil);
        var ttl = parseFloat(ttl_pem);
        var n = ttl_pem - (nilai * ttl / 100);
        var total = n.toLocaleString(undefined);
        $('.ttlHarga').html('<span class="pull-left">Rp. </span>' + total + ',00</div>')
    }

    function duitTunai(nil, ttl_pem, dis) {
        if (nil == '') {
            nil = 0;
        }
        if (dis == '') {
            dis = 0;
        }
        var diskon = parseFloat(dis);
        var ttl_dis = parseFloat(ttl_pem);
        var nd = ttl_pem - (diskon * ttl_dis / 100);
        var ni = nil.replace(".", "");
        var nilai = parseFloat(ni);
        var ttl = parseFloat(ttl_pem);
        var n = nilai - nd;
        var total = n.toLocaleString(undefined);
        $('.kembalian').html('<span class="pull-left">Rp. </span>' + total + ',00</div>')
    }


    function editQty(qty, aksi, kode_order, kode_menu) {
        var posting = $.post('<?= base_url() ?>index.php/transaksi/Trans_order/updateQtyEdit', {
            kode_order: kode_order,
            kode_menu: kode_menu,
            aksi: aksi,
            qty: qty
        });
        posting.done(function (data) {
            if (data == 'true') {
                load_tbl_menu(kode_order);
//                window.location.reload();
            } else {
                alert('Gagal');
            }
        });
    }
    function hapusKeranjang(kode_order, kode_menu) {
        var posting = $.post('<?= base_url() ?>index.php/transaksi/Trans_order/deleteKeranjangEdit', {
            kode_order: kode_order,
            kode_menu: kode_menu
        });
        posting.done(function (data) {
            if (data == 'true') {
//                window.location.reload();
                load_tbl_menu(kode_order);
            } else {
                alert('Gagal');
            }
        });
    }

</script>
