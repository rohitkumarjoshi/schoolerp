<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VehicleStudentAttendance $vehicleStudentAttendance
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Vehicle Student Attendance'), ['action' => 'edit', $vehicleStudentAttendance->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Vehicle Student Attendance'), ['action' => 'delete', $vehicleStudentAttendance->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vehicleStudentAttendance->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Vehicle Student Attendances'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vehicle Student Attendance'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vehicles'), ['controller' => 'Vehicles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vehicle'), ['controller' => 'Vehicles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="vehicleStudentAttendances view large-9 medium-8 columns content">
    <h3><?= h($vehicleStudentAttendance->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Student') ?></th>
            <td><?= $vehicleStudentAttendance->has('student') ? $this->Html->link($vehicleStudentAttendance->student->name, ['controller' => 'Students', 'action' => 'view', $vehicleStudentAttendance->student->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vehicle') ?></th>
            <td><?= $vehicleStudentAttendance->has('vehicle') ? $this->Html->link($vehicleStudentAttendance->vehicle->id, ['controller' => 'Vehicles', 'action' => 'view', $vehicleStudentAttendance->vehicle->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($vehicleStudentAttendance->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Taken By') ?></th>
            <td><?= $this->Number->format($vehicleStudentAttendance->taken_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($vehicleStudentAttendance->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($vehicleStudentAttendance->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('In Time') ?></th>
            <td><?= h($vehicleStudentAttendance->in_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Out Time') ?></th>
            <td><?= h($vehicleStudentAttendance->out_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($vehicleStudentAttendance->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($vehicleStudentAttendance->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($vehicleStudentAttendance->edited_on) ?></td>
        </tr>
    </table>
</div>
