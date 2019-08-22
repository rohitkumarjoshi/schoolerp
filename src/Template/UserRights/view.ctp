<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserRight $userRight
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User Right'), ['action' => 'edit', $userRight->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User Right'), ['action' => 'delete', $userRight->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userRight->id)]) ?> </li>
        <li><?= $this->Html->link(__('List User Rights'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Right'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="userRights view large-9 medium-8 columns content">
    <h3><?= h($userRight->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Employee') ?></th>
            <td><?= $userRight->has('employee') ? $this->Html->link($userRight->employee->name, ['controller' => 'Employees', 'action' => 'view', $userRight->employee->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Role') ?></th>
            <td><?= $userRight->has('role') ? $this->Html->link($userRight->role->name, ['controller' => 'Roles', 'action' => 'view', $userRight->role->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Menu Ids') ?></th>
            <td><?= h($userRight->menu_ids) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($userRight->id) ?></td>
        </tr>
    </table>
</div>
