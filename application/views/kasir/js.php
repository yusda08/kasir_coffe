<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/fancybox/jquery.fancybox.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<!--<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>-->
<script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-validation/src/localization/messages_id.js"></script>
<script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/croppie.js"></script>
<script>

    $(function () {
        $(".select2").select2();
        $('.tabel_1').DataTable();
        $('.tabel_2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': false
        });
        $('.tabel_3').DataTable({
            "scrollY": "400px",
            "scrollCollapse": true,
            "paging": false
                    //"scrollX": true
        });
    });
</script>   
<script>
    $(document).ready(function () {
        $("#flip").click(function () {
            $("#panel").slideToggle("slow");
        });
    });
    $(document).ready(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 200) {
                $('#to-top').fadeIn();
            } else {
                $('#to-top').fadeOut();
            }
        });
        $('#to-top').click(function () {
            $('html, body').animate({scrollTop: 0}, 600);
            return false;
        });
    });
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    });
    $(document).ready(function () {

    // Format mata uang.
    $('.uang').mask('0.000.000.000', {reverse: true});

    // Format nomor HP.
    $('.no_hp').mask('0000−0000−0000');

    // Format tahun pelajaran.
    $('.tapel').mask('0000/0000');
})
</script>
<script type="text/javascript">
    setTimeout(function () {
        $('#notiv').fadeOut('slow');
    }, 4000);

    $(document).ready(function () {
        var heights = $(".well_sama").map(function () {
            return $(this).height();
        }).get(),
                maxHeight = Math.max.apply(null, heights);

        $(".well_sama").height(maxHeight);


        $('.fancybox').fancybox();

    });
   $(document).ready(function () {
        var heights = $(".max").map(function () {
            return $(this).height();
        }).get(),
                maxHeight = Math.max.apply(null, heights);
        $(".max").height(maxHeight);
    });
</script>
