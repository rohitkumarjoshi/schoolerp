<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AppointmentMaster $appointmentMaster
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Appointment Master'), ['action' => 'edit', $appointmentMaster->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Appointment Master'), ['action' => 'delete', $appointmentMaster->id], ['confirm' => __('Are you sure you want to delete # {0}?', $appointmentMaster->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Appointment Masters'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Appointment Master'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Appointments'), ['controller' => 'Appointments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Appointment'), ['controller' => 'Appointments', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="appointmentMasters view large-9 medium-8 columns content">
    <h3><?= h($appointmentMaster->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Employee') ?></th>
            <td><?= $appointmentMaster->has('employee') ? $this->Html->link($appointmentMaster->employee->name, ['controller' => 'Employees', 'action' => 'view', $appointmentMaster->employee->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($appointmentMaster->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($appointmentMaster->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($appointmentMaster->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($appointmentMaster->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($appointmentMaster->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($appointmentMaster->edited_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Appointments') ?></h4>
        <?php if (!empty($appointmentMaster->appointments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Student Info Id') ?></th>
                <th scope="col"><?= __('Employee Id') ?></th>
                <th scope="col"><?= __('Guest Name') ?></th>
                <th scope="col"><?= __('Appointment Master Id') ?></th>
                <th scope="col"><?= __('Appointment Date') ?></th>
                <th scope="col"><?= __('Appointment Time') ?></th>
                <th scope="col"><?= __('Mobile No') ?></th>
                <th scope="col"><?= __('Reason') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($appointmentMaster->appointments as $appointments): ?>
            <tr>
                <td><?= h($appointments->id) ?></td>
                <td><?= h($appointments->student_info_id) ?></td>
                <td><?= h($appointments->employee_id) ?></td>
                <td><?= h($appointments->guest_name) ?></td>
                <td><?= h($appointments->appointment_master_id) ?></td>
                <td><?= h($appointments->appointment_date) ?></td>
                <td><?= h($appointments->appointment_time) ?></td>
                <td><?= h($appointments->mobile_no) ?></td>
                <td><?= h($appointments->reason) ?></td>
                <td><?= h($appointments->status) ?></td>
                <td><?= h($appointments->created_on) ?></td>
                <td><?= h($appointments->created_by) ?></td>
                <td><?= h($appointments->edited_on) ?></td>
                <td><?= h($appointments->edited_by) ?></td>
                <td><?= h($appointments->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Appointments', 'action' => 'view', $appointments->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Appointments', 'action' => 'edit', $appointments->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Appointments', 'action' => 'delete', $appointments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $appointments->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
