<!doctype html>
<html lang="en">
    <head>
    <?php echo view('template/head') ?>
    </head>
    <body class="fixed sidebar-collapse">
        <!-- Page Loader -->
        <!-- #END# Page Loader -->
        <div class="wrapper">
            <!-- Sidebar  -->
            <?php echo view('template/sidebar') ?>
            <!-- Page Content  -->
            <div class="content-wrapper">
                <div class="main-content">
                    <div class="page-loader-wrapper">
                        <div class="loader">
                            <div class="preloader">
                                <div class="spinner-layer pl-green">
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>
                            <p>Please wait...</p>
                        </div>
                    </div>
                   <?php echo view('template/header') ?>
                
                    <div class="body-content">
                        <?php echo view('template/messages') ?>
                        <?php
                            try{

                                $path               = 'App\Modules\"'.$module.'"\Views\"'.$page.'"';
                                $withourbackpath    = str_replace('/\/', '/', $path);
                                $viewpath           = str_replace('"', '', $withourbackpath);
                                echo view($viewpath);

                            } catch (Exception $e){
                                
                                echo "<pre><code>$e</code></pre>";
                            }
                        ?>
                    </div><!--/.body content-->
                </div><!--/.main content-->
                <footer class="footer-content">
                    <div class="footer-text d-flex align-items-center justify-content-between">
                        <?php echo htmlspecialchars_decode($settings->footer_text) ?>
                    </div>
                </footer><!--/.footer content-->
                <div class="overlay"></div>
            </div><!--/.wrapper-->
        </div>
        <?php echo view('template/footer') ?>
    </body>
</html>