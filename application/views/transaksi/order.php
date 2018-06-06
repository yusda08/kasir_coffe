<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = $this->session->userdata('is_login');
$msg = $this->session->flashdata('msg');
$tipe = $this->session->flashdata('tipe');
$lambang = 'fa-check';
$notify = 'Sukses!';
echo $javasc
?>   
<style>
    table, tbody, tr, td{
        font-size: 9pt;
    };
</style>
<div class="box ">
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
    <div class="box-header with-border">
        <a href="<?= base_url(); ?>index.php/transaksi/Trans_order/tambah_transaksi.html?kode_order=<?= $kode_order; ?>" 
           class="btn btn-flat btn-sm btn-warning"><i class="fa fa-plus"></i> Order</a>
        <!--        <button class="btn btn-warning btn-sm" data-toggle="modal" 
                        data-target="#aksi_order"
                        data-ket="tambah"></button>-->
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table class="tabel_3 table table-bordered table-hover" id="tabel_menu" width="100%">
                <thead>
                    <tr>
                        <th class="text-center"  width="3%">No</th>
                        <th class="text-center"  width="15%">Kode Order</th>
                        <th class="text-center"  >No Meja</th>
                        <th class="text-center"  >Nama Kasir</th>
                        <th class="text-center"  >Tanggal / Jam</th>
                        <th class="text-center"  >Sub Total</th>
                        <th class="text-center"  width="5%">Diskon</th>
                        <th class="text-center"  >Total</th>
                        <th class="text-center"  width="8%"><i class="fa fa-cog"></i></th>
                        <th class="text-center"  width="8%"><i class="fa fa-print"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $ttl_pemb_sub = 0;
                    $ttl_pemb_all = 0;
                    foreach ($get_transOrderJoinUser as $row) {
                        $ttl_pemb = @($row->ttl_pembayaran - ($row->ttl_pembayaran * $row->diskon / 100));
                        $ttl_pemb_sub += $row->ttl_pembayaran;
                        $ttl_pemb_all += $ttl_pemb;
                        ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td class="text-center"><?= $row->kode_order; ?></td>
                            <td class="text-center"><?= $row->no_meja; ?></td>
                            <td class=""><?= $row->nama_admin; ?></td>
                            <td class="text-center"><?= Tgl_indo::indo($row->tanggal) . "<br>" . $row->jam; ?></td>
                            <td class="text-right"><span class="pull-left">Rp. </span><?= number_format($row->ttl_pembayaran, 2, ',', '.'); ?></td>
                            <td class="text-center"><?= $row->diskon; ?> %</td>
                            <td class="text-right"><span class="pull-left">Rp. </span><?= number_format($ttl_pemb, 2, ',', '.'); ?></td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="<?= base_url(); ?>index.php/transaksi/Trans_order/edit_transaksi.html?kode_order=<?= $row->kode_order; ?>" 
                                       class="btn btn-flat btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                                    <button class="btn btn-flat btn-xs btn-danger" data-toggle="modal" 
                                            data-target="#deleteOrder" 
                                            data-kode_order = "<?= $row->kode_order; ?>"
                                            data-ket="hapus"><i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                            <td class="text-center">
                                <a target="_blank" href="<?= base_url(); ?>index.php/admin/laporan/laporan_html/cetak_strukOrder.html?kode_order=<?= $row->kode_order; ?>" class="btn btn-success btn-xs  btn-flat"><i class="fa fa-print"></i> Print</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-center"  colspan="5">T o t a l</th>
                        <th class="text-right"  ><span class="pull-left">Rp. </span><?= number_format($ttl_pemb_sub, 2, ',', '.'); ?></th>
                        <th class="text-center"  width="5%"></th>
                        <th class="text-right"  ><span class="pull-left">Rp. </span><?= number_format($ttl_pemb_all, 2, ',', '.'); ?></th>
                        <th class="text-center"  width="8%"></th>
                        <th class="text-center"  width="8%"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div><!-- /.box -->     

<div class="modal fade" id="deleteOrder" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gray-active">
                <button type="button" class="close" id="close-modal"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel">Form Hapus Data Order</h4>
            </div>
            <form action="<?= base_url(); ?>index.php/transaksi/Trans_order/deleteOrder.html" method="POST">
                <div class="modal-body">
                    <div class="hapusHidden">
                        <h4 class="alert bg-gray-active">Apakah Andayakin akan menghapus Order Ini. . ??</h4>
                        <note>*) Catatan : Apabila menghapus data pada Order Akan Terhapus.</note>
                    </div>
                    <input class="form-control kode_order" type="hidden" name="kode_order">
                    <input class="form-control" type="hidden" name="url" value="<?= $url; ?>">
                </div>
                <div class="modal-footer bg-gray-active">
                    <button type="submit" class="btn btn-default" data-dismiss="modal" aria-label="Close"> Tutup</button>
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#deleteOrder').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var kode_order = button.data('kode_order');
        var modal = $(this);
        modal.find('.modal-body input.kode_order').val(kode_order);
    });
</script>