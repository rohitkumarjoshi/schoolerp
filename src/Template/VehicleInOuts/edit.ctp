<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VehicleInOut $vehicleInOut
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $vehicleInOut->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $vehicleInOut->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Vehicle In Outs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Vehicles'), ['controller' => 'Vehicles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vehicle'), ['controller' => 'Vehicles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vehicleInOuts form large-9 medium-8 columns content">
    <?= $this->Form->create($vehicleInOut) ?>
    <fieldset>
        <legend><?= __('Edit Vehicle In Out') ?></legend>
        <?php
            echo $this->Form->control('vehicle_no');
            echo $this->Form->control('vehicle_id', ['options' => $vehicles]);
            echo $this->Form->control('in_date');
            echo $this->Form->control('in_time');
            echo $this->Form->control('out_date');
            echo $this->Form->control('out_time');
            echo $this->Form->control('remarks');
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
