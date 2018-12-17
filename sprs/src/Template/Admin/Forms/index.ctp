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
    <li>Manage Forms</li>  
</ul>
<div class="block">
    <!-- Responsive Full Title -->
    <div class="block-title">
        <div class="row">
            <div class="col-md-12">  
                <h2><strong>Manage Forms</strong></h2>    
            </div>

        </div>

    </div>
    <!-- END Responsive Full Title -->

    <!-- Responsive Full Content -->
    <div class="table-responsive row">  
        <div class="table-options clearfix">
            <div class="col-md-9">
                <div class="btn-group btn-group-sm pull-left">          
                    <a href="<?php echo $this->Url->build(['controller' => 'Forms', 'action' => 'add']); ?>" class="btn btn-primary" id="style-hover" data-toggle="tooltip" title="Add Form">Add Form</a>  
                </div>
            </div>
            <div class="col-md-3">
                <div class="btn-group btn-group-sm pull-right">                        
                </div>
            </div>
        </div>
        <table cellpadding="0" cellspacing="0" class="table table-vcenter table-striped">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('form_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
             <?php
                if (count($forms) > 0) {
            foreach ($forms as $form): ?>
            <tr>
                <td><?= $this->Number->format($form->id) ?></td>
                <td><?= h($form->form_name) ?></td>
                <td><?= h($form->created) ?></td>
                <td><?= h($form->modified) ?></td>
                <td class="actions">
                                <div class="btn-group btn-group-xs">

                                    
<!--                                    <a href="<?php //echo $this->Url->build(['controller' => 'Forms', 'action' => 'View', $form["id"]]); ?>" data-toggle="tooltip" title="View" class="btn btn-success"><i class="fa fa-eye"></i>-->
                                    
                                    <a href="<?php echo $this->Url->build(['controller' => 'Forms', 'action' => 'edit', $form["id"]]); ?>" data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                    <a href="javascript:void(0)" data-href="<?php echo $this->Url->build(['controller' => 'Forms', 'action' => 'delete', $form["id"]]); ?>" title="Delete" data-toggle="modal" data-target="#confirm-delete" data-toggle="tooltip" title="Delete" class="btn btn-danger"><i class="fa fa-times"></i></a>
        
                                   
                                </div>
                            </td>
            </tr>
            <?php endforeach;  
                }
                else{
                   ?> 
            
                    <tr>
                        <th colspan="6" align="center" class="no-record">
                            <?php echo Configure::read('NO_RECORD_FOUND'); ?>
                        </th>
                    </tr>
               <?php }
            ?>
            
        </tbody>
    </table>
    </div>
    <?php
    if (count($forms) > 0) {
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
