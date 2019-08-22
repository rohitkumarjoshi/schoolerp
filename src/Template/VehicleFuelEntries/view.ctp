<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VehicleFuelEntry $vehicleFuelEntry
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Vehicle Fuel Entry'), ['action' => 'edit', $vehicleFuelEntry->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Vehicle Fuel Entry'), ['action' => 'delete', $vehicleFuelEntry->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vehicleFuelEntry->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Vehicle Fuel Entries'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vehicle Fuel Entry'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vehicles'), ['controller' => 'Vehicles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vehicle'), ['controller' => 'Vehicles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="vehicleFuelEntries view large-9 medium-8 columns content">
    <h3><?= h($vehicleFuelEntry->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Vehicle') ?></th>
            <td><?= $vehicleFuelEntry->has('vehicle') ? $this->Html->link($vehicleFuelEntry->vehicle->id, ['controller' => 'Vehicles', 'action' => 'view', $vehicleFuelEntry->vehicle->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bill No') ?></th>
            <td><?= h($vehicleFuelEntry->bill_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($vehicleFuelEntry->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Filled By') ?></th>
            <td><?= $this->Number->format($vehicleFuelEntry->filled_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($vehicleFuelEntry->amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Previous Km') ?></th>
            <td><?= $this->Number->format($vehicleFuelEntry->previous_km) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Current Km') ?></th>
            <td><?= $this->Number->format($vehicleFuelEntry->current_km) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Liter') ?></th>
            <td><?= $this->Number->format($vehicleFuelEntry->liter) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Milege') ?></th>
            <td><?= $this->Number->format($vehicleFuelEntry->milege) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Difference Km') ?></th>
            <td><?= $this->Number->format($vehicleFuelEntry->difference_km) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($vehicleFuelEntry->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($vehicleFuelEntry->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fill Date') ?></th>
            <td><?= h($vehicleFuelEntry->fill_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($vehicleFuelEntry->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($vehicleFuelEntry->edited_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Remark') ?></h4>
        <?= $this->Text->autoParagraph(h($vehicleFuelEntry->remark)); ?>
    </div>
</div>
