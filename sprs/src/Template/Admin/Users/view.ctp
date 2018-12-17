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

<div class="modal-dialog modal-sm modal-sm-450">
    <div class="box box-primary">
        <div class="box-body box-profile"> 
            <!--h3 class="profile-username text-center">Details of : <?php echo h($user->firstname) . " " . h($user->lastname); ?></h3-->
            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b><?php echo __('Name'); ?></b>
                    <a class="pull-right"><?php echo h($user->firstname) . " " . h($user->lastname); ?></a>
                </li>
                <li class="list-group-item">
                    <b><?php echo __('Email'); ?></b>
                    <a class="pull-right"><?php echo h($user->email); ?></a>
                </li>
                <li class="list-group-item">
                    <b><?php echo __('Contact No'); ?></b>
                    <a class="pull-right"><?php echo h($user->contact_no); ?></a>
                </li>
                <li class="list-group-item">
                    <b><?php echo __('Address'); ?></b>
                    <a class=""><?php echo h($user->address); ?></a>
                </li>
                <li class="list-group-item">
                    <b><?php echo __('City'); ?></b>
                    <a class="pull-right"><?php echo ($user->city_id) ? h($user->city->name) : ""; ?></a>
                </li>
                <li class="list-group-item">
                    <b><?php echo __('UserName'); ?></b>
                    <a class="pull-right"><?php echo h($user->username); ?></a>
                </li>
                <li class="list-group-item">
                    <b><?php echo __('Added On'); ?></b>
                    <a class="pull-right"><?php echo date("m/d/Y H:i:s A", strtotime($user->created)); ?></a>
                </li>

            </ul>
        </div>
        <!-- /.box-body -->
    </div>
</div>