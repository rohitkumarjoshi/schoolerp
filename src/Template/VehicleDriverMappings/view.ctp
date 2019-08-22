<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VehicleDriverMapping $vehicleDriverMapping
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Vehicle Driver Mapping'), ['action' => 'edit', $vehicleDriverMapping->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Vehicle Driver Mapping'), ['action' => 'delete', $vehicleDriverMapping->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vehicleDriverMapping->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Vehicle Driver Mappings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vehicle Driver Mapping'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vehicles'), ['controller' => 'Vehicles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vehicle'), ['controller' => 'Vehicles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="vehicleDriverMappings view large-9 medium-8 columns content">
    <h3><?= h($vehicleDriverMapping->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Vehicle') ?></th>
            <td><?= $vehicleDriverMapping->has('vehicle') ? $this->Html->link($vehicleDriverMapping->vehicle->vehicle_no, ['controller' => 'Vehicles', 'action' => 'view', $vehicleDriverMapping->vehicle->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($vehicleDriverMapping->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($vehicleDriverMapping->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Driver Id') ?></th>
            <td><?= $this->Number->format($vehicleDriverMapping->driver_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Conductor Id') ?></th>
            <td><?= $this->Number->format($vehicleDriverMapping->conductor_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($vehicleDriverMapping->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($vehicleDriverMapping->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Assign Date') ?></th>
            <td><?= h($vehicleDriverMapping->assign_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($vehicleDriverMapping->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($vehicleDriverMapping->edited_on) ?></td>
        </tr>
    </table>
</div>
