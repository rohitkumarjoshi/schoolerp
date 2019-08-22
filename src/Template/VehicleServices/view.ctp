<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VehicleService $vehicleService
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Vehicle Service'), ['action' => 'edit', $vehicleService->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Vehicle Service'), ['action' => 'delete', $vehicleService->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vehicleService->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Vehicle Services'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vehicle Service'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vehicles'), ['controller' => 'Vehicles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vehicle'), ['controller' => 'Vehicles', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vendors'), ['controller' => 'Vendors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vendor'), ['controller' => 'Vendors', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Drivers'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Driver'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="vehicleServices view large-9 medium-8 columns content">
    <h3><?= h($vehicleService->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Vehicle') ?></th>
            <td><?= $vehicleService->has('vehicle') ? $this->Html->link($vehicleService->vehicle->vehicle_no, ['controller' => 'Vehicles', 'action' => 'view', $vehicleService->vehicle->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Driver') ?></th>
            <td><?= $vehicleService->has('driver') ? $this->Html->link($vehicleService->driver->name, ['controller' => 'Employees', 'action' => 'view', $vehicleService->driver->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bill No') ?></th>
            <td><?= h($vehicleService->bill_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vendor') ?></th>
            <td><?= $vehicleService->has('vendor') ? $this->Html->link($vehicleService->vendor->name, ['controller' => 'Vendors', 'action' => 'view', $vehicleService->vendor->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($vehicleService->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Km') ?></th>
            <td><?= $this->Number->format($vehicleService->km) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($vehicleService->amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($vehicleService->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($vehicleService->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Service Date') ?></th>
            <td><?= h($vehicleService->service_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Next Service') ?></th>
            <td><?= h($vehicleService->next_service) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($vehicleService->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($vehicleService->edited_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Remark') ?></h4>
        <?= $this->Text->autoParagraph(h($vehicleService->remark)); ?>
    </div>
</div>
