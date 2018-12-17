<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>

<p class="text-success text-center"><i class="icon fa fa-check"></i> <?php echo h($message) ?></p>
