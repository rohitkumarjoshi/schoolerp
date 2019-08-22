<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Leave $leave
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Leave'), ['action' => 'edit', $leave->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Leave'), ['action' => 'delete', $leave->id], ['confirm' => __('Are you sure you want to delete # {0}?', $leave->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Leaves'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Leave'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="leaves view large-9 medium-8 columns content">
    <h3><?= h($leave->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Session Year') ?></th>
            <td><?= $leave->has('session_year') ? $this->Html->link($leave->session_year->id, ['controller' => 'SessionYears', 'action' => 'view', $leave->session_year->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Student') ?></th>
            <td><?= $leave->has('student') ? $this->Html->link($leave->student->name, ['controller' => 'Students', 'action' => 'view', $leave->student->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Half Day') ?></th>
            <td><?= h($leave->half_day) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Halfday Type') ?></th>
            <td><?= h($leave->halfday_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($leave->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($leave->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($leave->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Action By') ?></th>
            <td><?= $this->Number->format($leave->action_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($leave->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($leave->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date From') ?></th>
            <td><?= h($leave->date_from) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date To') ?></th>
            <td><?= h($leave->date_to) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Action Date') ?></th>
            <td><?= h($leave->action_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($leave->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($leave->edited_on) ?></td>
        </tr>
    </table>
</div>
