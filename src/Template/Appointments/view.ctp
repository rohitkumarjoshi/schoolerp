<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Appointment $appointment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Appointment'), ['action' => 'edit', $appointment->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Appointment'), ['action' => 'delete', $appointment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $appointment->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Appointments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Appointment'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Student Infos'), ['controller' => 'StudentInfos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Info'), ['controller' => 'StudentInfos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Appointment Masters'), ['controller' => 'AppointmentMasters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Appointment Master'), ['controller' => 'AppointmentMasters', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="appointments view large-9 medium-8 columns content">
    <h3><?= h($appointment->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Student Info') ?></th>
            <td><?= $appointment->has('student_info') ? $this->Html->link($appointment->student_info->id, ['controller' => 'StudentInfos', 'action' => 'view', $appointment->student_info->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Employee') ?></th>
            <td><?= $appointment->has('employee') ? $this->Html->link($appointment->employee->name, ['controller' => 'Employees', 'action' => 'view', $appointment->employee->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Guest Name') ?></th>
            <td><?= h($appointment->guest_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Appointment Master') ?></th>
            <td><?= $appointment->has('appointment_master') ? $this->Html->link($appointment->appointment_master->id, ['controller' => 'AppointmentMasters', 'action' => 'view', $appointment->appointment_master->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mobile No') ?></th>
            <td><?= h($appointment->mobile_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($appointment->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($appointment->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($appointment->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($appointment->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($appointment->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Appointment Date') ?></th>
            <td><?= h($appointment->appointment_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Appointment Time') ?></th>
            <td><?= h($appointment->appointment_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($appointment->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($appointment->edited_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Reason') ?></h4>
        <?= $this->Text->autoParagraph(h($appointment->reason)); ?>
    </div>
</div>
