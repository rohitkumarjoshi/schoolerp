<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VehicleFeedback $vehicleFeedback
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Vehicle Feedback'), ['action' => 'edit', $vehicleFeedback->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Vehicle Feedback'), ['action' => 'delete', $vehicleFeedback->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vehicleFeedback->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Vehicle Feedbacks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vehicle Feedback'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vehicles'), ['controller' => 'Vehicles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vehicle'), ['controller' => 'Vehicles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="vehicleFeedbacks view large-9 medium-8 columns content">
    <h3><?= h($vehicleFeedback->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Student') ?></th>
            <td><?= $vehicleFeedback->has('student') ? $this->Html->link($vehicleFeedback->student->name, ['controller' => 'Students', 'action' => 'view', $vehicleFeedback->student->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vehicle') ?></th>
            <td><?= $vehicleFeedback->has('vehicle') ? $this->Html->link($vehicleFeedback->vehicle->id, ['controller' => 'Vehicles', 'action' => 'view', $vehicleFeedback->vehicle->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($vehicleFeedback->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Driver Id') ?></th>
            <td><?= $this->Number->format($vehicleFeedback->driver_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($vehicleFeedback->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($vehicleFeedback->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($vehicleFeedback->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($vehicleFeedback->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($vehicleFeedback->edited_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($vehicleFeedback->comment)); ?>
    </div>
</div>
