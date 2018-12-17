<?php
$file = $theme['folder'] . DS . 'src' . DS . 'Template' . DS . 'Element' . DS . 'aside' . DS . 'sidebar-menu.ctp';

if (file_exists($file)) {
    ob_start();
    include_once $file;
    echo ob_get_clean();
} else {
    ?>


    <ul class="sidebar-nav">

        <li class="sidebar-header">
            <span class="sidebar-header-options clearfix"><a href="javascript:void(0)" data-toggle="tooltip" title="Quick Settings"><i class="gi gi-settings"></i></a><a href="javascript:void(0)" data-toggle="tooltip" title="Create the most amazing pages with the widget kit!"><i class="gi gi-lightbulb"></i></a></span>
            <span class="sidebar-header-title">Menu</span>  
        </li>


        <li>
            <?php
            echo $this->Html->link(__('<i class="fa fa-hospital-o sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide">Dashboard </span>'), ['prefix' => 'admin', 'controller' => 'Dashboards', 'action' => 'index'], ['class' => '', 'escape' => false]);
            ?>
        </li> 
        <li>
            <?php
            echo $this->Html->link(__('<i class="fa fa-user-md sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide">Manage Doctors</span>'), ['prefix' => 'admin', 'controller' => 'Doctors', 'action' => 'index'], ['class' => '', 'escape' => false]);
            ?>
        </li>
        <li>
            <?php
            echo $this->Html->link(__('<i class="fa fa-wheelchair sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide">Manage Patients</span>'), ['prefix' => 'admin', 'controller' => 'Patients', 'action' => 'index'], ['class' => '', 'escape' => false]);
            ?>
        </li>
        <li>
            <?php
            echo $this->Html->link(__('<i class="fa fa-file-text sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide">Manage Forms</span>'), ['prefix' => 'admin', 'controller' => 'Forms', 'action' => 'index'], ['class' => '', 'escape' => false]);
            ?>
        </li>


        <?php /* <li class="treeview">
          <a href="#" class="sidebar-nav-menu  "><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-file sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Static Pages</span></a>
          <ul style="display: none;">
          <li>
          <?php
          echo $this->Html->link(__('<i class="gi gi-book sidebar-nav-icon"></i> <span style="padding-left:20px" class="sidebar-nav-mini-hide">Terms of use</span>'), ['prefix' => 'admin', 'controller' => 'StaticContents', 'action' => 'add', 'terms'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<i class="gi gi-book sidebar-nav-icon"></i> <span style="padding-left:20px" class="sidebar-nav-mini-hide">About Us</span>'), ['prefix' => 'admin', 'controller' => 'StaticContents', 'action' => 'add', 'about'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<i class="gi gi-book sidebar-nav-icon"></i> <span style="padding-left:20px" class="sidebar-nav-mini-hide">Privacy Policies</span>'), ['prefix' => 'admin', 'controller' => 'StaticContents', 'action' => 'add', 'privacy'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          li>
          <?php
          //echo $this->Html->link(__('<!--i class="gi gi-stopwatch sidebar-nav-icon"></i <span style="padding-left:20px" class="sidebar-nav-mini-hide">Rented Bike Time wise</span>'), ['prefix' => 'admin', 'controller' => 'Reports', 'action' => 'rentedBikesReports'], ['class' => '', 'escape' => false]);
          ?>
          </li
          <li>
          <?php
          echo $this->Html->link(__('<i class="gi gi-book sidebar-nav-icon"></i> <span style="padding-left:20px" class="sidebar-nav-mini-hide">Cancellation Policies</span>'), ['prefix' => 'admin', 'controller' => 'StaticContents', 'action' => 'add', 'policy'], ['class' => '', 'escape' => false]);
          ?>
          </li>

          </ul>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<i class="gi gi-group sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide">Manage Riders</span>'), ['prefix' => 'admin', 'controller' => 'Riders', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<i class="fa fa-bicycle  sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide">Rider Request for Bike</span>'), ['prefix' => 'admin', 'controller' => 'RiderSlots', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<i class="gi gi-group sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide">Manage Customers</span>'), ['prefix' => 'admin', 'controller' => 'Customers', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>

          li>
          <?php
          // echo $this->Html->link(__('<i class="gi gi-stopwatch sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide">Manage Timeslots</span>'), ['prefix' => 'admin', 'controller' => 'Timeslots', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li

          <li>
          <?php
          echo $this->Html->link(__('<i class="gi gi-group sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide">Manage Rides</span>'), ['prefix' => 'admin', 'controller' => 'Rides', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<i class="gi gi-stopwatch  sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide">Manage Timeslots</span>'), ['prefix' => 'admin', 'controller' => 'Timeslots', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<i class="fa fa-tags sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide">Manage Promocodes</span>'), ['prefix' => 'admin', 'controller' => 'Promocodes', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>


          li>
          <?php
          echo $this->Html->link(__('<i class="gi gi-stopwatch sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Riders Live Tracking</span>'), ['prefix' => 'admin', 'controller' => 'Tracking', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li

          <li>
          <?php
          echo $this->Html->link(__('<i class="gi gi-stopwatch sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Manage Commision</span>'), ['prefix' => 'admin', 'controller' => 'Commision', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <?php if ($current_user["role_id"] == 1) { ?>
          <li>
          <a href="#" class="sidebar-nav-menu <?php if ($frontEnd) { ?> open <?php } ?>"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-certificate sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Frontend</span></a>
          <ul style="<?php if ($frontEnd) { ?>display: block;<?php } else { ?>display: none;<?php } ?>">
          <li>
          <?php
          echo $this->Html->link(__('i class="gi gi-stopwatch sidebar-nav-icon"></i <span style="padding-left:20px" class="sidebar-nav-mini-hide">Manage Features</span>'), ['prefix' => 'admin', 'controller' => 'Buildingfeatures', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('i class="gi gi-stopwatch sidebar-nav-icon"></i <span style="padding-left:20px" class="sidebar-nav-mini-hide">Manage Amenities</span>'), ['prefix' => 'admin', 'controller' => 'Amenities', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<span style="padding-left:20px" class="sidebar-nav-mini-hide">Manage Services</span>'), ['prefix' => 'admin', 'controller' => 'Services', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<span style="padding-left:20px" class="sidebar-nav-mini-hide">Manage Team</span>'), ['prefix' => 'admin', 'controller' => 'TeamPersons', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <li>
          <?php
          //echo $this->Html->link(__('<i class="gi gi-stopwatch sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide">Localization</span>'), ['controller' => 'Categories', 'action' => 'index'], ['class' => $categories, 'escape' => false]
          //);
          ?>
          <a href="#" class="sidebar-nav-menu <?php if ($aboutUs) { ?> open <?php } ?>"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-certificate sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Manage AboutUs</span></a>
          <ul style="<?php if ($aboutUs) { ?>display: block;<?php } else { ?>display: none;<?php } ?>">
          <li>
          <?php
          echo $this->Html->link(__('<span style="padding-left:20px" class="sidebar-nav-mini-hide">About Us(Home)</span>'), ['prefix' => 'admin', 'controller' => 'AboutUsHome', 'action' => 'add'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<span style="padding-left:20px" class="sidebar-nav-mini-hide">About Us(Static)</span>'), ['prefix' => 'admin', 'controller' => 'AboutUsStatic', 'action' => 'add'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          </ul>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<span style="padding-left:20px" class="sidebar-nav-mini-hide">Manage FAQ(s)</span>'), ['prefix' => 'admin', 'controller' => 'Faqs', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<span style="padding-left:20px" class="sidebar-nav-mini-hide">Manage Gallery</span>'), ['prefix' => 'admin', 'controller' => 'GalleryPhotos', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>

          </ul>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<i class="gi gi-stopwatch sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide">Manage Vendors</span>'), ['prefix' => 'admin', 'controller' => 'Vendors', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<i class="gi gi-stopwatch sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide">Manage Agents</span>'), ['prefix' => 'admin', 'controller' => 'Agents', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>

          <li>
          <?php
          echo $this->Html->link(__('<i class="gi gi-stopwatch sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide">Manage Buildings</span>'), ['prefix' => 'admin', 'controller' => 'Buildings', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<i class="gi gi-stopwatch sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide">Manage Apartments</span>'), ['prefix' => 'admin', 'controller' => 'Apartments', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<i class="gi gi-stopwatch sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide">Manage Cars</span>'), ['prefix' => 'admin', 'controller' => 'Cars', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<i class="gi gi-stopwatch sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide">Manage Phonelines</span>'), ['prefix' => 'admin', 'controller' => 'Phonelines', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<i class="gi gi-stopwatch sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide">Manage Customers</span>'), ['prefix' => 'admin', 'controller' => 'Customers', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<i class="gi gi-stopwatch sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide">Manage Inquiries</span>'), ['prefix' => 'admin', 'controller' => 'Inquiries', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<i class="gi gi-stopwatch sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide">Manage Expenses</span>'), ['prefix' => 'admin', 'controller' => 'OtherExpenses', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>

          <li>
          <?php
          echo $this->Html->link(__('<i class="gi gi-stopwatch sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide">Manage Task List</span>'), ['prefix' => 'admin', 'controller' => 'TaskLists', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<i class="gi gi-stopwatch sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide">Manage Bookings</span>'), ['prefix' => 'admin', 'controller' => 'BookingInfo', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<i class="gi gi-stopwatch sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide">Manage Invoices</span>'), ['prefix' => 'admin', 'controller' => 'Invoices', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>


          <?php } else { ?>
          <li>
          <?php
          echo $this->Html->link(__('<i class="gi gi-stopwatch sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide">Manage To Do List</span>'), ['prefix' => 'admin', 'controller' => 'TaskLists', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <?php } ?>


          <li class="treeview">
          <a href="#" class="sidebar-nav-menu  "><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-certificate sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Manage Issues</span></a>
          <ul style="display: none;">
          <li>
          <?php
          echo $this->Html->link(__('<i class="fa fa-bug sidebar-nav-icon"></i> <span style="padding-left:20px" class="sidebar-nav-mini-hide">Issue Subjects</span>'), ['prefix' => 'admin', 'controller' => 'IssueSubjects', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<i class="fa fa-bug sidebar-nav-icon"></i><span style="padding-left:20px" class="sidebar-nav-mini-hide">Issues</span>'), ['prefix' => 'admin', 'controller' => 'Issues', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>

          li>
          <?php
          //echo $this->Html->link(__('i class="gi gi-stopwatch sidebar-nav-icon"></i <span style="padding-left:20px" class="sidebar-nav-mini-hide">Rented Bike Time wise</span>'), ['prefix' => 'admin', 'controller' => 'Reports', 'action' => 'rentedBikesReports'], ['class' => '', 'escape' => false]);
          ?>
          </li
          <li>
          <?php
          echo $this->Html->link(__('<span style="padding-left:20px" class="sidebar-nav-mini-hide">Cancellation Policies</span>'), ['prefix' => 'admin', 'controller' => 'StaticContents', 'action' => 'add', 'policy'], ['class' => '', 'escape' => false]);
          ?>
          </li>

          </ul>
          </li>
          <li class="treeview">
          <a href="#" class="sidebar-nav-menu  "><i class="fa fa-angle-left  sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-pie_chart sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Reports</span></a>
          <ul style="display: none;">

          <li>
          <?php
          echo $this->Html->link(__('<i class="fa fa-euro sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide style="padding-left:20px"> TurnOver</span>'), ['prefix' => 'admin', 'controller' => 'Reports', 'action' => 'turnover_report'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<i class="fa fa-euro sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide style="padding-left:20px" "> NetIncome</span>'), ['prefix' => 'admin', 'controller' => 'Reports', 'action' => 'netincome_report'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<i class="fa fa-bell sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide style="padding-left:20px" "> WorkingHours</span>'), ['prefix' => 'admin', 'controller' => 'Reports', 'action' => 'workinghours_report'], ['class' => '', 'escape' => false]);
          ?>
          </li>


          </ul>
          </li>

          <li>
          <?php
          echo $this->Html->link(__('<i class="fa fa-question-circle  sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Manage FAQ(s)</span>'), ['prefix' => 'admin', 'controller' => 'Faqs', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<i class="fa fa-gear fa-spin  sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Manage Bonus Rules</span>'), ['prefix' => 'admin', 'controller' => 'BonusRules', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<i class="fa fa-envelope sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Manage Email Template</span>'), ['prefix' => 'admin', 'controller' => 'Emailmanagement', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>

          <li>
          <?php
          echo $this->Html->link(__('<i class="fa fa-bell sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Manage Notifications</span>'), ['prefix' => 'admin', 'controller' => 'Notifications', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<i class="fa fa-briefcase  sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Configuration Data</span>'), ['prefix' => 'admin', 'controller' => 'Configurations', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li>
          <li>
          <?php
          echo $this->Html->link(__('<i class="gi gi-stopwatch sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Manage Tracking</span>'), ['prefix' => 'admin', 'controller' => 'Tracking', 'action' => 'index'], ['class' => '', 'escape' => false]);
          ?>
          </li> */ ?>
    </ul>
<?php } ?>
