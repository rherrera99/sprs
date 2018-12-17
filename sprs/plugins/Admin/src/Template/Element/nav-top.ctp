<header class="navbar navbar-default navbar-fixed-top">
    <!-- Left Header Navigation -->
    <ul class="nav navbar-nav-custom">
        <!-- Main Sidebar Toggle Button -->
        <li>
            <a href="javascript:void(0)" id="toggle_sidebar_btn" onclick="">
                <i class="fa fa-bars fa-fw"></i>
            </a>
        </li>
        <!-- END Main Sidebar Toggle Button -->
    </ul>
    <!-- END Left Header Navigation -->


    <!-- Right Header Navigation -->
    <ul class="nav navbar-nav-custom pull-right">

        <!-- User Dropdown -->
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                <?php
                echo $this->Html->image('Admin.avatar5.png', [
                    'alt' => 'Profile Photo'
                ]);
                ?>
                <?php //echo $current_user['full_name'] ?> <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                <li class="dropdown-header text-center">Account</li>

                <li class="divider"></li>
                <li>
<!--                    <a href="javascript:void(0)">
                        <i class="fa fa-user fa-fw pull-right"></i>
                        Profile
                    </a>-->
                    <!-- Opens the user settings modal that can be found at the bottom of each page (page_footer.html in PHP version) -->
<!--                    <a href="javascript:void(0)" data-toggle="modal">
                        <i class="fa fa-cog fa-fw pull-right"></i>
                        Settings
                    </a>-->
                    <?php
                    echo $this->Html->link(__('<i class="fa fa-user fa-fw pull-right"></i> Change Password'), ['controller' => 'Users', 'action' => 'passwordChanage'], ['escape' => false],["data-toggle"=>"dropdown"]
                    );
                    ?>
                    <?php
                    echo $this->Html->link(__('<i class="fa fa-ban fa-fw pull-right"></i> Logout'), ['controller' => 'Users', 'action' => 'logout'], ['escape' => false]
                    );
                    ?>
                </li>
            </ul>
        </li>
        <!-- END User Dropdown -->
    </ul>
    <!-- END Right Header Navigation -->
</header>
<script>
    $("#toggle_sidebar_btn").click(function() {
        var old_val=$.cookie('toggle_sidebar');
        if(parseInt(old_val)==0){
            $.cookie('toggle_sidebar', 1, {'path': "/"});
        }else{
            $.cookie('toggle_sidebar', 0, {'path': "/"});
        }
        
        App.sidebar('toggle-sidebar');
        this.blur();
    });
</script>