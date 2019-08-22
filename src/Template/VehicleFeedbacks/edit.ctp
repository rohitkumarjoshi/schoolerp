<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VehicleFeedback $vehicleFeedback
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $vehicleFeedback->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $vehicleFeedback->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Vehicle Feedbacks'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vehicles'), ['controller' => 'Vehicles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vehicle'), ['controller' => 'Vehicles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vehicleFeedbacks form large-9 medium-8 columns content">
    <?= $this->Form->create($vehicleFeedback) ?>
    <fieldset>
        <legend><?= __('Edit Vehicle Feedback') ?></legend>
        <?php
            echo $this->Form->control('student_id', ['options' => $students]);
            echo $this->Form->control('vehicle_id', ['options' => $vehicles]);
            echo $this->Form->control('driver_id');
            echo $this->Form->control('date');
            echo $this->Form->control('comment');
            echo $this->Form->control('created_on');
            echo $this->Form->control('created_by');
            echo $this->Form->control('edited_on');
            echo $this->Form->control('edited_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
