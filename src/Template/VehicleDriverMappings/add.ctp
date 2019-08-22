<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VehicleDriverMapping $vehicleDriverMapping
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Vehicle Driver Mappings'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Vehicles'), ['controller' => 'Vehicles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vehicle'), ['controller' => 'Vehicles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vehicleDriverMappings form large-9 medium-8 columns content">
    <?= $this->Form->create($vehicleDriverMapping) ?>
    <fieldset>
        <legend><?= __('Add Vehicle Driver Mapping') ?></legend>
        <?php
            echo $this->Form->control('vehicle_id', ['options' => $vehicles]);
            echo $this->Form->control('driver_id');
            echo $this->Form->control('conductor_id');
            echo $this->Form->control('assign_date');
            echo $this->Form->control('created_on');
            echo $this->Form->control('created_by');
            echo $this->Form->control('edited_on');
            echo $this->Form->control('edited_by');
            echo $this->Form->control('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
