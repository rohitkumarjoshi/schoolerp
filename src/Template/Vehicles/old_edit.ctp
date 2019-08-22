<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Vehicle $vehicle
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $vehicle->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $vehicle->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Vehicles'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Expenses'), ['controller' => 'Expenses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Expense'), ['controller' => 'Expenses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Student Infos'), ['controller' => 'StudentInfos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student Info'), ['controller' => 'StudentInfos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vehicle Driver Mappings'), ['controller' => 'VehicleDriverMappings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vehicle Driver Mapping'), ['controller' => 'VehicleDriverMappings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vehicle Feedbacks'), ['controller' => 'VehicleFeedbacks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vehicle Feedback'), ['controller' => 'VehicleFeedbacks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vehicle Fuel Entries'), ['controller' => 'VehicleFuelEntries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vehicle Fuel Entry'), ['controller' => 'VehicleFuelEntries', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vehicle Routes'), ['controller' => 'VehicleRoutes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vehicle Route'), ['controller' => 'VehicleRoutes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vehicle Services'), ['controller' => 'VehicleServices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vehicle Service'), ['controller' => 'VehicleServices', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vehicle Student Attendances'), ['controller' => 'VehicleStudentAttendances', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vehicle Student Attendance'), ['controller' => 'VehicleStudentAttendances', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vehicles form large-9 medium-8 columns content">
    <?= $this->Form->create($vehicle) ?>
    <fieldset>
        <legend><?= __('Edit Vehicle') ?></legend>
        <?php
            echo $this->Form->control('vehicle_no');
            echo $this->Form->control('vehicle_type');
            echo $this->Form->control('vechicle_company');
            echo $this->Form->control('city_reg');
            echo $this->Form->control('model_no');
            echo $this->Form->control('engine_no');
            echo $this->Form->control('condition');
            echo $this->Form->control('year_manufacturing');
            echo $this->Form->control('color');
            echo $this->Form->control('chasis_no');
            echo $this->Form->control('insurance_date');
            echo $this->Form->control('insurance_expiry_date');
            echo $this->Form->control('insurance_doc');
            echo $this->Form->control('poc_doc');
            echo $this->Form->control('poc_date');
            echo $this->Form->control('poc_expiry_date');
            echo $this->Form->control('permit_doc');
            echo $this->Form->control('permit_date');
            echo $this->Form->control('permit_expiry_date');
            echo $this->Form->control('fuel_type');
            echo $this->Form->control('status');
            echo $this->Form->control('created_on');
            echo $this->Form->control('created_by');
            echo $this->Form->control('edited_on');
            echo $this->Form->control('edited_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
