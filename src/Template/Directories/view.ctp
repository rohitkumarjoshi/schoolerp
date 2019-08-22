<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Directory $directory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Directory'), ['action' => 'edit', $directory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Directory'), ['action' => 'delete', $directory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $directory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Directories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Directory'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="directories view large-9 medium-8 columns content">
    <h3><?= h($directory->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Employee') ?></th>
            <td><?= $directory->has('employee') ? $this->Html->link($directory->employee->name, ['controller' => 'Employees', 'action' => 'view', $directory->employee->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mobile No') ?></th>
            <td><?= h($directory->mobile_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($directory->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($directory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($directory->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($directory->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($directory->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($directory->edited_on) ?></td>
        </tr>
    </table>
</div>
