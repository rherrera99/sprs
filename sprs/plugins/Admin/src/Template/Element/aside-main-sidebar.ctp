<!-- Main Sidebar -->
<div id="sidebar">
    <!-- Wrapper for scrolling functionality -->
    <div id="sidebar-scroll">
        <!-- Sidebar Content -->
        <div class="sidebar-content">
            <!-- Brand -->
            <a href="<?php echo $this->Url->build(['prefix' => 'admin','controller' => 'Dashboards', 'action' => 'index']); ?>" class="sidebar-brand">
                <i class="gi gi-flash"></i><span class="sidebar-nav-mini-hide">SPRS</span>

            </a>
            <!-- END Brand -->

            <!-- Theme Colors -->
            <!-- Change Color Theme functionality can be found in js/app.js - templateOptions() -->
            	<?php //echo $this->element('Admin.aside/sidebar-theme-colors'); ?>
            <!-- END Theme Colors -->

            <!-- Sidebar Navigation -->
            	<?php echo $this->element('Admin.aside/sidebar-menu'); ?>
            <!-- END Sidebar Navigation -->

        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->
</div>
<!-- END Main Sidebar -->


