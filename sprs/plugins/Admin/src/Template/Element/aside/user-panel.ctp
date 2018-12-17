<?php
$file = $theme['folder'] . DS . 'src' . DS . 'Template' . DS . 'Element' . DS . 'aside' . DS . 'user-panel.ctp';

if (file_exists($file)) {
    ob_start();
    include_once $file;
    echo ob_get_clean();
} else {
?>
<div class="user-panel">
    <div class="pull-left image">
        <?php 
            echo $this->Html->image('Admin.avatar5.png', [
                'class' => 'img-circle', 
                'alt' => $current_user['firstname']." ".$current_user['lastname']]
            ); 
        ?>
    </div>
    <div class="pull-left info">
        <p><?php echo (!empty($current_user)) ? $current_user['firstname']." ".$current_user['lastname'] : "Admin"; ?></p>
        <a href="javascript:void(0);"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
</div>
<?php } ?>