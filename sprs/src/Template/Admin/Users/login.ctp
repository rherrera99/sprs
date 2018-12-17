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

<!-- Login Title -->
<div class="login-title text-center">
    <h1><i class="gi gi-lock"></i> <strong>Social Patients Record System</strong><br><small>Please <strong>Login</strong></small></h1>
</div>
<!-- END Login Title -->
<!-- Login Block -->
<div class="block push-bit">
    <!-- Login Form -->
    <?php echo $this->Flash->render(); ?>
    <?php
    echo $this->Form->create('', [
        'id' => 'form-login',
        'class' => 'form-horizontal form-bordered form-control-borderless'
    ]);
    ?>
    <div class="form-group">
        <div class="col-xs-12">
            <div class="input-group">
                <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                <?php
                echo $this->Form->input('email', [
                    'id' => 'email',
                    'type' => 'email',
                    'class' => 'form-control input-lg required',
                    'placeholder' => 'Email',
                    'label' => false
                ]);
                ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-12">
            <div class="input-group">
                <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                <?php
                echo $this->Form->input('password', [
                    'id' => 'password',
                    'type' => 'password',
                    'class' => 'form-control input-lg required',
                    'placeholder' => 'Password',
                    'label' => false
                ]);
                ?>
            </div>
        </div>
    </div>
    <div class="form-group form-actions">
<!--        <div class="col-xs-4">
            <label class="switch switch-primary" data-toggle="tooltip" title="Remember Me?">
                <input type="checkbox" id="login-remember-me" name="login-remember-me" checked>
                <span></span>
            </label>
        </div>-->
        <div class="col-xs-8 text-right">
            <!-- <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Login to Dashboard</button> -->
            <?php
            echo $this->Form->button('<i class="fa fa-angle-right"></i> Login to Dashboard', [
                'type' => 'submit',
                'class' => 'btn btn-sm btn-primary',
                'escape' => false
            ]);
            ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-12 text-center">
           <a href="#" class=" " id="style-hover" data-toggle="tooltip" ><small>Forgot password</small></a>
        </div>
    </div>
<?php echo $this->Form->end(); ?>
    <!-- END Login Form -->

    <!-- Reminder Form -->
    <form action="login_full.html#reminder" method="post" id="form-reminder" class="form-horizontal form-bordered form-control-borderless display-none">
        <div class="form-group">
            <div class="col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                    <?php
                    echo $this->Form->input('email', [
                        'id' => 'email',
                        'type' => 'email',
                        'class' => 'form-control input-lg required',
                        'placeholder' => 'Email',
                        'label' => false
                    ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group form-actions">
            <div class="col-xs-12 text-right">
                <?php
                echo $this->Form->button('<i class="fa fa-angle-right"></i> Reset Password', [
                    'type' => 'submit',
                    'class' => 'btn btn-sm btn-primary',
                    'escape' => false
                ]);
                ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12 text-center">
                <small>Did you remember your password?</small> <a href="javascript:void(0)" id="link-reminder"><small>Login</small></a>
            </div>
        </div>
    </form>
    <!-- END Reminder Form -->
</div>
<!-- END Login Block -->
