<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TimeTablePeriod $timeTablePeriod
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Time Table Period'), ['action' => 'edit', $timeTablePeriod->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Time Table Period'), ['action' => 'delete', $timeTablePeriod->id], ['confirm' => __('Are you sure you want to delete # {0}?', $timeTablePeriod->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Time Table Periods'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Time Table Period'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Student Classes'), ['controller' => 'StudentClasses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Class'), ['controller' => 'StudentClasses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Streams'), ['controller' => 'Streams', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stream'), ['controller' => 'Streams', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sections'), ['controller' => 'Sections', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Section'), ['controller' => 'Sections', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="timeTablePeriods view large-9 medium-8 columns content">
    <h3><?= h($timeTablePeriod->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Student Class') ?></th>
            <td><?= $timeTablePeriod->has('student_class') ? $this->Html->link($timeTablePeriod->student_class->name, ['controller' => 'StudentClasses', 'action' => 'view', $timeTablePeriod->student_class->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stream') ?></th>
            <td><?= $timeTablePeriod->has('stream') ? $this->Html->link($timeTablePeriod->stream->name, ['controller' => 'Streams', 'action' => 'view', $timeTablePeriod->stream->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Section') ?></th>
            <td><?= $timeTablePeriod->has('section') ? $this->Html->link($timeTablePeriod->section->name, ['controller' => 'Sections', 'action' => 'view', $timeTablePeriod->section->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subject') ?></th>
            <td><?= $timeTablePeriod->has('subject') ? $this->Html->link($timeTablePeriod->subject->name, ['controller' => 'Subjects', 'action' => 'view', $timeTablePeriod->subject->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Day') ?></th>
            <td><?= h($timeTablePeriod->day) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Employee') ?></th>
            <td><?= $timeTablePeriod->has('employee') ? $this->Html->link($timeTablePeriod->employee->name, ['controller' => 'Employees', 'action' => 'view', $timeTablePeriod->employee->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($timeTablePeriod->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($timeTablePeriod->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Medium Id') ?></th>
            <td><?= $this->Number->format($timeTablePeriod->medium_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($timeTablePeriod->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($timeTablePeriod->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Time From') ?></th>
            <td><?= h($timeTablePeriod->time_from) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Time To') ?></th>
            <td><?= h($timeTablePeriod->time_to) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($timeTablePeriod->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($timeTablePeriod->edited_on) ?></td>
        </tr>
    </table>
</div>
