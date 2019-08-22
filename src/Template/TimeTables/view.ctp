<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TimeTable $timeTable
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Time Table'), ['action' => 'edit', $timeTable->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Time Table'), ['action' => 'delete', $timeTable->id], ['confirm' => __('Are you sure you want to delete # {0}?', $timeTable->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Time Tables'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Time Table'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="timeTables view large-9 medium-8 columns content">
    <h3><?= h($timeTable->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Session Year') ?></th>
            <td><?= $timeTable->has('session_year') ? $this->Html->link($timeTable->session_year->id, ['controller' => 'SessionYears', 'action' => 'view', $timeTable->session_year->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Doc') ?></th>
            <td><?= h($timeTable->doc) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($timeTable->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($timeTable->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($timeTable->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($timeTable->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Valid From') ?></th>
            <td><?= h($timeTable->valid_from) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Valid To') ?></th>
            <td><?= h($timeTable->valid_to) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($timeTable->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($timeTable->edited_on) ?></td>
        </tr>
    </table>
</div>
