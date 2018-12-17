<?php

/**
 * @var \App\View\AppView $this
 */
use Cake\Core\Configure;

echo $this->Html->css('Admin./plugins/cakephp-ajax-pagination/ajaxpagination');
?>
<ul class="breadcrumb breadcrumb-top">
    <li>
        <a href="<?php echo $this->Url->build(['controller' => 'Dashboards', 'action' => 'index']); ?>">Dashboard</a>
    </li>
    <li>Manage Users</li>  
</ul>
<div class="block">
    <!-- Responsive Full Title -->
    <div class="block-title">
        <div class="row">
            <div class="col-md-12">  
                <h2><strong>Manage users</strong></h2>    
            </div>

        </div>

    </div>
    <!-- END Responsive Full Title -->

    <!-- Responsive Full Content -->
    <div class="table-responsive row">  
        <div class="table-options clearfix">
            <div class="col-md-9">
                <div class="btn-group btn-group-sm pull-left">          
                    <a href="<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'add']); ?>" class="btn btn-primary" id="style-hover" data-toggle="tooltip" title="Add New User">Add User</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="btn-group btn-group-sm pull-right">                        
                </div>
            </div>
        </div>
        <table class="table table-vcenter table-striped">
            <thead>
                <tr>                        
                    <!--th>id</th-->
                    <th>Name</th>
                    <th>Email</th>

                    <th>Contact No</th>
                    <!--th>Address</th-->   
                    <th>City</th>
                    <th>User Type</th>
                    <th>Added On</th>
                    <th>Is Active</th>       
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php
                if (!$users->isEmpty()) {

                    foreach ($users->toArray() as $user) {
                        $role_id = (int) $user["role_id"];
                        $roleArray = Configure::read("USER_TYPE");
                        ?>
                        <tr>  
                            <td><?php echo h($user["firstname"] . " " . $user["lastname"]); ?></td>   
                            <td><?php echo h($user["email"]); ?></td>   
                            <td><?php echo h($user["contact_no"]); ?></td>   
                            <!--td><?php echo h($user["address"]); ?></td-->   
                            <td><?php echo h($user["city"]["name"]); ?></td>   
                            <td><?php echo $roleArray[$role_id]; ?></td>          
                            <td><?php
                                $dob = new \DateTime($user["created"], new \DateTimeZone('UTC'));
                                $dob->setTimeZone(new \DateTimeZone($currentTimezone));
                                echo $dob->format('m/d/Y');
                                ?></td>
                            <td><?php echo $user["is_active"] == 1 ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>'; ?></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-xs">
                                    <?php echo $this->Html->link(__('<i class="fa fa-fw fa-eye"></i>'), ['controller' => 'users', 'action' => 'view', $user["id"]], ['class' => 'btn btn-xs btn-info view-remote-modal ajax-modal-popup', 'escape' => false]); ?>
                                    <a href="<?php echo $this->Url->build(['controller' => 'users', 'action' => 'edit', $user["id"]]); ?>" data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                    <a href="javascript:void(0)" data-href="<?php echo $this->Url->build(['controller' => 'users', 'action' => 'delete', $user["id"]]); ?>" title="Delete" data-toggle="modal" data-target="#confirm-delete" data-toggle="tooltip" title="Delete" class="btn btn-danger"><i class="fa fa-times"></i></a>
                                </div>
                            </td>
                        </tr>

                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <th colspan="6" align="center" class="no-record">
                            <?php echo Configure::read('NO_RECORD_FOUND'); ?>
                        </th>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
    if (!$users->isEmpty()) {
        ?>
        <div class="row">
            <div class="col-sm-12 col-xs-12 clearfix">
                <div class="dataTables_paginate paging_bootstrap" id="example-datatable_paginate">
                    <?php echo $this->element('Admin.ajax-modal'); ?>
                    <?php echo $this->element('Admin.pagination'); ?>
                    <?php echo $this->element('Admin.delete-confirmation'); ?>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <!-- END Responsive Full Content -->
</div>
<!-- END Responsive Full Block -->

<?php echo $this->Html->script('Admin./plugins/cakephp-ajax-pagination/ajaxpaginate.min') ?>
<script>
    $(function() {
        $('.ajax-pagination').cakephpPagination({
            paginateDivId: "pagination-div"
        });
    });
</script> 
<script type="text/javascript">

</script>
