<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VehicleRoute $vehicleRoute
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Vehicle Route'), ['action' => 'edit', $vehicleRoute->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Vehicle Route'), ['action' => 'delete', $vehicleRoute->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vehicleRoute->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Vehicle Routes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vehicle Route'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vehicles'), ['controller' => 'Vehicles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vehicle'), ['controller' => 'Vehicles', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vehicle Stations'), ['controller' => 'VehicleStations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vehicle Station'), ['controller' => 'VehicleStations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="vehicleRoutes view large-9 medium-8 columns content">
    <h3><?= h($vehicleRoute->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Vehicle') ?></th>
            <td><?= $vehicleRoute->has('vehicle') ? $this->Html->link($vehicleRoute->vehicle->id, ['controller' => 'Vehicles', 'action' => 'view', $vehicleRoute->vehicle->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vehicle Station') ?></th>
            <td><?= $vehicleRoute->has('vehicle_station') ? $this->Html->link($vehicleRoute->vehicle_station->name, ['controller' => 'VehicleStations', 'action' => 'view', $vehicleRoute->vehicle_station->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($vehicleRoute->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Station Order By') ?></th>
            <td><?= $this->Number->format($vehicleRoute->station_order_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($vehicleRoute->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($vehicleRoute->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pickup Time') ?></th>
            <td><?= h($vehicleRoute->pickup_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Drop Time') ?></th>
            <td><?= h($vehicleRoute->drop_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($vehicleRoute->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($vehicleRoute->edited_on) ?></td>
        </tr>
    </table>
</div>
