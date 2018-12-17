<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Form'), ['action' => 'edit', $form->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Form'), ['action' => 'delete', $form->id], ['confirm' => __('Are you sure you want to delete # {0}?', $form->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Forms'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Form'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Formdetails'), ['controller' => 'Formdetails', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Formdetail'), ['controller' => 'Formdetails', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="forms view large-9 medium-8 columns content">
    <h3><?= h($form->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Form Name') ?></th>
            <td><?= h($form->form_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($form->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($form->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($form->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Formdetails') ?></h4>
        <?php if (!empty($form->formdetails)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Form Id') ?></th>
                <th scope="col"><?= __('Field Name') ?></th>
                <th scope="col"><?= __('Field Type') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($form->formdetails as $formdetails): ?>
            <tr>
                <td><?= h($formdetails->id) ?></td>
                <td><?= h($formdetails->form_id) ?></td>
                <td><?= h($formdetails->field_name) ?></td>
                <td><?= h($formdetails->field_type) ?></td>
                <td><?= h($formdetails->created) ?></td>
                <td><?= h($formdetails->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Formdetails', 'action' => 'view', $formdetails->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Formdetails', 'action' => 'edit', $formdetails->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Formdetails', 'action' => 'delete', $formdetails->id], ['confirm' => __('Are you sure you want to delete # {0}?', $formdetails->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
