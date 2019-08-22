<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HostelAttendance $hostelAttendance
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Hostel Attendance'), ['action' => 'edit', $hostelAttendance->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Hostel Attendance'), ['action' => 'delete', $hostelAttendance->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hostelAttendance->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Hostel Attendances'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hostel Attendance'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Hostel Registrations'), ['controller' => 'HostelRegistrations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hostel Registration'), ['controller' => 'HostelRegistrations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="hostelAttendances view large-9 medium-8 columns content">
    <h3><?= h($hostelAttendance->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Session Year') ?></th>
            <td><?= $hostelAttendance->has('session_year') ? $this->Html->link($hostelAttendance->session_year->id, ['controller' => 'SessionYears', 'action' => 'view', $hostelAttendance->session_year->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Student') ?></th>
            <td><?= $hostelAttendance->has('student') ? $this->Html->link($hostelAttendance->student->name, ['controller' => 'Students', 'action' => 'view', $hostelAttendance->student->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hostel Registration') ?></th>
            <td><?= $hostelAttendance->has('hostel_registration') ? $this->Html->link($hostelAttendance->hostel_registration->id, ['controller' => 'HostelRegistrations', 'action' => 'view', $hostelAttendance->hostel_registration->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($hostelAttendance->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($hostelAttendance->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($hostelAttendance->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($hostelAttendance->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($hostelAttendance->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Time') ?></th>
            <td><?= h($hostelAttendance->time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($hostelAttendance->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($hostelAttendance->edited_on) ?></td>
        </tr>
    </table>
</div>
