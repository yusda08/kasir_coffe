<!DOCTYPE html>
<html>
    <head>
        <?= $head; ?>
    </head>
    <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
    <body class="hold-transition skin-blue layout-top-nav">
        <div class="wrapper">

            <header class="main-header ">
                <nav class="navbar navbar-static-top" style="background-color: #000;">
                    <div class="container">
                        <?= $nav; ?>
                        <!-- /.navbar-custom-menu -->
                    </div>
                    <!-- /.container-fluid -->
                </nav>
            </header>
            <!-- Full Width Column -->
            <div class="content-wrapper">
                <div class="container">
                    <!-- Content Header (Page header) -->
                    <?php if (isset($name_page)) { ?>
                        <section class="content-header">

                            <h1>
                                <?= $name_page; ?>
                                <small><?= $name_page_small; ?></small>
                            </h1>
                        </section>
                    <?php } ?>
                    <!-- Main content -->
                    <section class="content">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-6">
                                <span class="pull-right">
                                    <div id='notivs'></div>
                                </span>
                            </div>
                        </div>
                        <?= $content; ?>
                        <!-- /.box -->
                    </section>
                    <!-- /.content -->
                </div>
                <!-- /.container -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer" style="background-color: #000; color: #FFF">
                <?= $footer; ?>
            </footer>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 3 -->

    </body>
</html>
