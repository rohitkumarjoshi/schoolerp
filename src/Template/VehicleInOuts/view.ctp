<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VehicleInOut $vehicleInOut
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Vehicle In Out'), ['action' => 'edit', $vehicleInOut->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Vehicle In Out'), ['action' => 'delete', $vehicleInOut->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vehicleInOut->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Vehicle In Outs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vehicle In Out'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vehicles'), ['controller' => 'Vehicles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vehicle'), ['controller' => 'Vehicles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="vehicleInOuts view large-9 medium-8 columns content">
    <h3><?= h($vehicleInOut->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Vehicle No') ?></th>
            <td><?= h($vehicleInOut->vehicle_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vehicle') ?></th>
            <td><?= $vehicleInOut->has('vehicle') ? $this->Html->link($vehicleInOut->vehicle->vehicle_no, ['controller' => 'Vehicles', 'action' => 'view', $vehicleInOut->vehicle->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Remarks') ?></th>
            <td><?= h($vehicleInOut->remarks) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($vehicleInOut->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($vehicleInOut->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($vehicleInOut->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($vehicleInOut->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('In Date') ?></th>
            <td><?= h($vehicleInOut->in_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('In Time') ?></th>
            <td><?= h($vehicleInOut->in_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Out Date') ?></th>
            <td><?= h($vehicleInOut->out_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Out Time') ?></th>
            <td><?= h($vehicleInOut->out_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($vehicleInOut->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($vehicleInOut->edited_on) ?></td>
        </tr>
    </table>
</div>
