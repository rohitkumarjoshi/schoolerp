<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Genders'), ['controller' => 'Genders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Gender'), ['controller' => 'Genders', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Hostels'), ['controller' => 'Hostels', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Hostel'), ['controller' => 'Hostels', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Item Issue Returns'), ['controller' => 'ItemIssueReturns', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Issue Return'), ['controller' => 'ItemIssueReturns', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="employees form large-9 medium-8 columns content">
    <?= $this->Form->create($employee) ?>
    <fieldset>
        <legend><?= __('Add Employee') ?></legend>
        <?php
            echo $this->Form->control('session_year_id', ['options' => $sessionYears]);
            echo $this->Form->control('name');
            echo $this->Form->control('dob');
            echo $this->Form->control('parmanent_address');
            echo $this->Form->control('correspondence_address');
            echo $this->Form->control('marital_status');
            echo $this->Form->control('gender_id', ['options' => $genders]);
            echo $this->Form->control('city_id', ['options' => $cities]);
            echo $this->Form->control('state_id', ['options' => $states]);
            echo $this->Form->control('role_id');
            echo $this->Form->control('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
