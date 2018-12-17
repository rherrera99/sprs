<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo isset($theme['title']) ? $theme['title'] : 'Trio Cab | Log in'; ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

        <?php
        echo $this->Html->meta('favicon.png', 'Admin./img/favicon.png', [
            'type' => 'icon'
        ]);
        ?>


        <!-- Bootstrap 3.3.5 -->
        <?php echo $this->Html->css('Admin.bootstrap.min'); ?>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" rel="stylesheet">
        
        <!-- Related styles of various icon packs and plugins -->
        <?php echo $this->Html->css('Admin.plugins'); ?>

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <?php echo $this->Html->css('Admin.main'); ?>

        <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->
        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <?php echo $this->Html->css('Admin.themes'); ?>
        <!-- END Stylesheets -->

        <!-- Toastr -->
        <?php echo $this->Html->css('Admin./plugins/toastr/css/toastr.min'); ?>

        <!-- Modernizr (browser feature detection library) & Respond.js (enables responsive CSS code on browsers that don't support it, eg IE8) -->
        <?php echo $this->Html->script('Admin.vendor/modernizr-respond.min'); ?>

        <!-- Custom CSS --> 
        <?php echo $this->Html->css('Admin.style'); ?>
        <?php echo $this->Html->css('Admin./plugins/intlInputPhone/css/intlTelInput'); ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- jQuery 2.2.3 -->
        <?php echo $this->Html->script('Admin.vendor/jquery-2.2.3.min'); ?>
        <!-- Bootstrap 3.3.5 -->
        <?php echo $this->Html->script('Admin.vendor/bootstrap.min'); ?>
        <?php echo $this->Html->script('Admin.plugins'); ?>
        <?php echo $this->Html->script('Admin.app'); ?>

    </head>
    <body>
        <div id="page-wrapper">
<!--            <div class="preloader themed-background">
                <h1 class="push-top-bottom text-light text-center">On<strong>Z</strong>Way</h1>
                <div class="inner">
                    <h3 class="text-light visible-lt-ie9 visible-lt-ie10"><strong>Loading..</strong></h3>
                    <div class="preloader-spinner hidden-lt-ie9 hidden-lt-ie10"></div>
                </div>
            </div>-->
            <div id="page-container" class="header-fixed-top sidebar-mini sidebar-no-animations sidebar-visible-lg footer-fixed">

                <!-- Sidebar Starts -->
                <?php echo $this->element('Admin.aside-main-sidebar'); ?>
                <!-- Sidebar Ends -->

                <!--  Main Content Starts -->
                <div id="main-container">
                    <!-- Header Starts -->
                    <?php echo $this->element('Admin.nav-top'); ?>
                    <!-- Header Ends -->

                    <!-- Page Content Starts -->
                    <div id="page-content">
                        <?php echo $this->fetch('content'); ?>
                    </div>
                    <!-- Page Content Ends -->

                    <!-- Footer -->
                    <?php echo $this->element('Admin.footer'); ?>
                    <!-- END Footer -->                
                </div>
                <!--  Main Content Ends -->

            </div>
        </div>

        <!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
        <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>


<!-- <script>!window.jQuery && document.write(decodeURI('%3Cscript src="js/vendor/jquery-2.2.3.min.min.js"%3E%3C/script%3E'));</script> -->

        <!-- Bootstrap.js, Jquery plugins and Custom JS code -->
        <input type="hidden" id="utilJs" value="<?php echo BASE_URL . 'admin/plugins/intlInputPhone/js/utils.js'; ?>"/>
        <!-- Toastr -->
        <?php echo $this->Html->script('Admin./plugins/toastr/js/toastr.min'); ?>
        <?php echo $this->Html->script('Admin./plugins/intlInputPhone/js/intlTelInput.min'); ?>
        <?php echo $this->Html->script('Admin.custom'); ?>
        <?php echo $this->element('Admin.notification-messages'); ?>
    </body>
    <script type="text/javascript">
        $(document).ready(function() {
            //sidebar-visible-lg 
            var a = $('a[href="<?php echo $this->request->webroot . $this->request->url ?>"]');
            if (!a.parent().hasClass('treeview')) {
                a.addClass('active');
                a.parent().parents('.treeview').find(".sidebar-nav-menu").addClass('open');
                a.parent().parents('ul').show();
            }
            var toggle_sidebar=$.cookie('toggle_sidebar');
            if(parseInt(toggle_sidebar)==0){
                //$("#page-container").addClass("sidebar-visible-lg");
            }else{
                App.sidebar('toggle-sidebar');
                this.blur();//$("#page-container").addClass("sidebar-visible-lg-mini");
            }
        });
    </script>
</html>
