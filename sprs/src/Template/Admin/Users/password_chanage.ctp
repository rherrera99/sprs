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
<ul class="breadcrumb breadcrumb-top">
    <li>
        <a href="<?php echo $this->Url->build(['controller' => 'Dashboards', 'action' => 'index']); ?>">Dashboard</a>
    </li>
    <li>Change Password</li>
</ul>
<div class="block">
    <!-- Responsive Full Title -->
    <div class="block-title">
        <h2><strong>Change Password</strong></h2>
    </div>
    <div class="" id="add_doctor_form">
        <?php echo $this->Form->create($user,['id'=>'user']); ?>

        <div class="row">
            
            <div class="col-xs-12 form-group">
                
                <div class="form-group col-xs-10">
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
            </div>
                        <div class="col-xs-12 form-group">
                
                <div class="form-group col-xs-10">
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
        </div>
        <div class="col-xs-offset-2 form-group form-actions">
            <button type="submit" class="btn btn-sm btn-primary">
                <i class="fa fa-plus"></i> Save
            </button>

        </div>
        <?php echo $this->Form->end(); ?>
    </div>


</div>

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
    
     $(function() {
 
     
     setInterval(function(){ $('.dropdown-menu-right').css('display',''); }, 300);




    });
</script>