<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Scaling $scaling
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Scaling'), ['action' => 'edit', $scaling->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Scaling'), ['action' => 'delete', $scaling->id], ['confirm' => __('Are you sure you want to delete # {0}?', $scaling->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Scalings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Scaling'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="scalings view large-9 medium-8 columns content">
    <h3><?= h($scaling->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Session Year') ?></th>
            <td><?= $scaling->has('session_year') ? $this->Html->link($scaling->session_year->id, ['controller' => 'SessionYears', 'action' => 'view', $scaling->session_year->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subject') ?></th>
            <td><?= $scaling->has('subject') ? $this->Html->link($scaling->subject->name, ['controller' => 'Subjects', 'action' => 'view', $scaling->subject->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($scaling->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($scaling->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Scale No') ?></th>
            <td><?= $this->Number->format($scaling->scale_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($scaling->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($scaling->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($scaling->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($scaling->edited_on) ?></td>
        </tr>
    </table>
</div>
