<?php
$a = $this->session->userdata('is_login');
error_reporting(0);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $head; ?>    
        <style>
            #notivs {
                width: 50%;
                position: absolute;
                z-index: 999;
                top: 10px;
                right: 10px;
            }
        </style>
    </head>
    <body class="hold-transition skin-yellow-light sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <?php echo $nav_header; ?>  
            </header>
            <aside class="main-sidebar">
                <?php echo $nav; ?>  
            </aside>
            <div class="content-wrapper">
                <?php if ($name_page != '') { ?>
                    <section class="content-header bg-gray" style="padding-bottom: 20px;">
                        <h1>
                            <?= $name_page; ?>
                            <small><?= $name_page_small; ?></small>
                        </h1>
                    </section>
                <?php } ?>
                <section class="content">
                    <div class="row">
                            <div class="col-md-6 col-md-offset-6">
                                <span class="pull-right">
                                    <div id='notivs'></div>
                                </span>
                            </div>
                        </div>
                    <?php echo $content; ?>
                </section>
            </div>
            <footer class="main-footer" style="background-color: #0d3349; color: #ffffff;">
                <?= $footer; ?>
            </footer>
        </div>

    </body>
</html>
