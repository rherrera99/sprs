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

        <!-- Related styles of various icon packs and plugins -->
        <?php echo $this->Html->css('Admin.plugins'); ?>

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <?php echo $this->Html->css('Admin.main'); ?>

        <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->
        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <?php echo $this->Html->css('Admin.themes'); ?>
        <!-- END Stylesheets -->

        <!-- Modernizr (browser feature detection library) & Respond.js (enables responsive CSS code on browsers that don't support it, eg IE8) -->
        <?php echo $this->Html->script('Admin.vendor/modernizr-respond.min'); ?>

        <!-- Custom CSS -->
        <?php echo $this->Html->css('Admin.style'); ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- jQuery 2.2.3 -->
        <?php echo $this->Html->script('Admin.vendor/jquery-2.2.3.min'); ?>
        <!-- Bootstrap 3.3.5 -->
        <?php echo $this->Html->script('Admin./bootstrap/js/bootstrap'); ?>

    </head>
    <body class="hold-transition login-page">

        <!-- Login Full Background -->
        <!-- For best results use an image with a resolution of 1280x1280 pixels (prefer a blurred image for smaller file size) -->
        <?php
        //echo $theme['login']['logo'] 
//        echo $this->Html->image('Admin.placeholders/backgrounds/login_full_bg.jpg', [
//            'class' => 'full-bg animation-pulseSlow',
//            'alt' => 'Login Full Background'
//        ]);
        ?>
        <!-- END Login Full Background -->

        <div id="login-container" class="animation-fadeIn">
            <?php echo $this->fetch('content'); ?>
        </div>

        <!-- /.login-box -->

        <?php echo $this->Html->script('Admin.vendor/jquery-2.2.3.min'); ?>
        <script>!window.jQuery && document.write(decodeURI('%3Cscript src="js/vendor/jquery-2.2.3.min.js"%3E%3C/script%3E'));</script>

        <!-- Bootstrap.js, Jquery plugins and Custom JS code -->
        <?php echo $this->Html->script('Admin.vendor/bootstrap.min'); ?>
        <?php echo $this->Html->script('Admin.plugins'); ?>
        <?php echo $this->Html->script('Admin.app'); ?>

        <script type="text/javascript">

            $(function() {
                var d = new Date();
                $.cookie('currentTimezone', d, {'path': "/"});
                var old_val=$.cookie('toggle_sidebar');
                if(old_val != undefined){
                    
                    $.cookie('toggle_sidebar', old_val, {'path': "/"});
                }else{
                    $.cookie('toggle_sidebar', 0, {'path': "/"});
                }
            });

        </script>
        <!-- Load and execute javascript code used only in this page -->
        <?php echo $this->Html->script('Admin.pages/login'); ?>
        <!--script>$(function(){ Login.init(); });</script-->

    </body>
</html>
