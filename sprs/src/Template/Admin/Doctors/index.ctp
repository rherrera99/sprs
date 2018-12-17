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
    <li>Manage Doctors</li>  
</ul>
<div class="block">
    <!-- Responsive Full Title -->
    <div class="block-title">
        <div class="row">
            <div class="col-md-12">  
                <h2><strong>Manage Doctors</strong></h2>    
            </div>

        </div>

    </div>
    <!-- END Responsive Full Title -->

    <!-- Responsive Full Content -->
    <div class="table-responsive row">  
        <div class="table-options clearfix">
            <div class="col-md-9">
                <div class="btn-group btn-group-sm pull-left">          
                    <a href="<?php echo $this->Url->build(['controller' => 'Doctors', 'action' => 'add']); ?>" class="btn btn-primary" id="style-hover" data-toggle="tooltip" title="Add Doctors">Add Doctors</a>  
                </div>
            </div>
            <div class="col-md-3">
                <div class="btn-group btn-group-sm pull-right">                        
                </div>
            </div>
        </div>
        <table class="table table-vcenter table-striped">
            <thead>
                <tr >                        
                    <!--th>id</th-->
                    <th>Profile Pic</th>
                    <th>Name</th>
                    <th>Contact No</th>
                    <th>Email</th>   

                    <th>Is Active</th>       
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php
                if (count($doctors) > 0) {

                    foreach ($doctors as $doctor) {
                        //print_r($doctor);
                        ?>
                        <tr style="height: 70px;<?php if($doctor["is_delete"]) {?>background:#E91E63<?php }?>">  
                            <td><?php if ($doctor['profile_pic']) { ?><img src="<?php echo Configure::read("DOCTOR_PROFILE_URL") . $doctor["profile_pic"]; ?>" style="height:50px;width:50px"/> <?php } else{ if($doctor["gender"]==1){?> <img src="<?php echo Configure::read("DEFAULT_AVTAR"); ?>" style="height:50px;width:50px"/> <?php }else{?><img src="<?php echo Configure::read("DEFAULT_AVTARFEMALE"); ?>" style="height:50px;width:50px"/><?php } ?><?php }?></td>
                            <td><?php echo h($doctor["first_name"] . " " . $doctor["last_name"]); ?></td>   
                            <td><?php echo h($doctor["contact_no"]); ?></td>  
                            <td><?php echo h($doctor["email"]); ?></td>  
                            <td><?php echo $doctor["status"] == 1 ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>'; ?></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-xs">

                                    <a href="<?php echo $this->Url->build(['controller' => 'Doctors', 'action' => 'edit', $doctor["id"]]); ?>" data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                    <?php if(!$doctor["is_delete"]) {?><a href="javascript:void(0)" data-href="<?php echo $this->Url->build(['controller' => 'Doctors', 'action' => 'delete', $doctor["id"]]); ?>" title="Delete" data-toggle="modal" data-target="#confirm-delete" data-toggle="tooltip" title="Delete" class="btn btn-danger"><i class="fa fa-times"></i></a><?php } ?>
        <!--                                    <a type="button" class="btn btn-sm btn-primary" style="float:right;margin: 2px 10px;" href="<?php echo $this->Url->build(['prefix' => false, 'controller' => 'Common', 'action' => 'apartmentlease', 70, "_ext" => "pdf"]); ?>">
                                        Apartment Lease
                                    </a>
                                    <a type="button" class="btn btn-sm btn-primary" style="float:right;margin: 2px 10px;" href="<?php echo $this->Url->build(['prefix' => false, 'controller' => 'Common', 'action' => 'carlease', 54, "_ext" => "pdf"]); ?>">
                                        Car Lease
                                    </a>-->
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
    if (count($doctors) > 0) {
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
