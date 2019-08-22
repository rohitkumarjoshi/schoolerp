<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ReservationCategory $reservationCategory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Reservation Categories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Student Infos'), ['controller' => 'StudentInfos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student Info'), ['controller' => 'StudentInfos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="reservationCategories form large-9 medium-8 columns content">
    <?= $this->Form->create($reservationCategory) ?>
    <fieldset>
        <legend><?= __('Add Reservation Category') ?></legend>
        <?php
            echo $this->Form->control('short_name');
            echo $this->Form->control('full_name');
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
