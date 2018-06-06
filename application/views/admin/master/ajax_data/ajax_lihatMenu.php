<div id='lihatMenu'>
    <table class="tabel_3 table table-bordered table-hover" id="tabel_menu" width="100%">
        <thead>
            <tr>
                <th class="text-center" style="background-color: #A6A4A4" width="15%">Kode Menu</th>
                <th class="text-center" style="background-color: #A6A4A4" >Nama Menu</th>
                <th class="text-center" style="background-color: #A6A4A4" >Harga Menu</th>
                <th class="text-center" style="background-color: #A6A4A4" width="5%">Diskon</th>
                <th class="text-center" style="background-color: #A6A4A4" width="5%"><i class="fa fa-trash"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($get_dataMenuWhereJenis as $row_nm) {
                ?>
                <tr>
                    <td class="text-center"><?= $row_nm->kode_menu; ?></td>
                    <td class=""><?= $row_nm->nama_menu; ?></td>
                    <td class="text-right"><span class="pull-left">Rp. </span><?= number_format($row_nm->harga_menu, 2, ',', '.'); ?></td>
                    <td class="text-center"><?= $row_nm->diskon_menu; ?> %</td>
                    <td class="no-padding"><button type="button" onclick="hapusMenu('<?= $row_nm->kode_menu; ?>', 'hapus', '<?= $row_nm->id_jenis_menu; ?>');" class="btn btn-danger btn-flat btn-block btn-sm todo"  title="Hapus Jenis Menu" ><i class="fa fa-trash"></i></button></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    function hapusMenu(id, ket, id_jenis_menu) {
        $.ajax({
            type: 'post',
            url: '<?= base_url(); ?>index.php/admin/Master/deleteMenu',
            data: {id: id},
            success: function (data) {
                if (data == 'true') {
                    sukses_menu(ket, id_jenis_menu);
                } else {
                    gagal_menu(ket);
                }
            }
        })
    }
    function sukses_menu(ket, id_jenis_menu) {
        $("#notivs").html('<div class="alert alert-success alert-dismissable animated fadeIn" id="notification"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="icon fa fa-check"></i> Sukses!</h4> Berhasil di ' + ket + '. </div>');
        loadMenu(id_jenis_menu);
        setTimeout(function () {
            $('#notification').fadeOut('slow');
        }, 2000);
    }

    function gagal_menu(ket) {
        $("#notivs").html('<div class="alert alert-danger alert-dismissible" id="alert-notification"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Peringatan!</h4> Gagal Di Simpan. </div>');
        setTimeout(function () {
            $('#alert-notification').fadeOut('slow');
        }, 2000);
    }

    function loadMenu(id_jenis_menu) {
        $.ajax({
            type: 'POST',
            url: '<?= base_url(); ?>index.php/admin/Master/lihat_menu',
            data: {id_jenis_menu: id_jenis_menu},
            success: function (data) {
                $('#lihatMenu').html(data);
            }
        });
    }


    $(document).ready(function () {
        $('.tabel_3').DataTable({
            "scrollY": "400px",
            "scrollX": true,
            "scrollCollapse": true,
            "paging": false
        });
    })
</script>