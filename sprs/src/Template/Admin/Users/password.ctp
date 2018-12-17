<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Core\Configure;
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo __('Add Category') ?>
  </h1>
  <ol class="breadcrumb">
    <li>
        <a href="<?php echo $this->Url->build(['controller' => 'Categories','action' => 'index']); ?>"><i class="fa fa-tags">
            </i> <?php echo __('Manage Categories') ?>
        </a>
    </li>
    <li class="active"><?php echo __('Add Category') ?></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-purple">
                <!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->Form->create($user,['id'=>'user']); ?>
                    <div class="box-body">
                        
                        <div class="form-group">
                            <?php 
                                echo $this->Form->input('password',[
                                    'id' => 'password',
                                    'type' => 'password',
                                    'class' => 'form-control required',
                                    'placeholder' => 'Enter New Password',
                                    'label' => ['text' => 'New Password'],
                                    'value' => ''
                                ]);
                            ?>
                        </div>

                        <div class="form-group">
                            <?php 
                                echo $this->Form->input('confirm_password',[
                                    'id' => 'confirm_password',
                                    'type' => 'password',
                                    'class' => 'form-control required',
                                    'placeholder' => 'Enter Confirm Password',
                                    'default' => ''
                                ]);
                            ?>
                        </div>
                        
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <?php 
                            echo $this->Form->button(__('Save'),[
                                'type' => 'submit',
                                'class' => 'btn btn-primary btn-form'
                            ]);
                        ?>
                    </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</section>

<?php echo $this->Html->script('Admin./plugins/jquery-validation/jquery.validate.min'); ?>
<?php echo $this->Html->script('Admin./plugins/jquery-validation/additional-methods.min'); ?>

<script type="text/javascript">    

    $( "#user" ).validate({
        rules: {
            /*password: {
                remote: "<?php //echo $this->Url->build(['controller' => 'categories', 'action' => 'checkUniqueCategory']); ?>",
            },*/
            password: {
                minlength: 6
            },
            confirm_password : {
                equalTo: "#password"
            }
        },
        messages :{
            /*name: {
                remote: "This value is already in use"  
            }*/
            confirm_password : {
                equalTo: "Confirm password must match with password"
            }
        }
    });
</script>