<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HealthMaster $healthMaster
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Health Masters'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Student Healths'), ['controller' => 'StudentHealths', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student Health'), ['controller' => 'StudentHealths', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="healthMasters form large-9 medium-8 columns content">
    <?= $this->Form->create($healthMaster) ?>
    <fieldset>
        <legend><?= __('Add Health Master') ?></legend>
        <?php
            echo $this->Form->control('health_type');
            echo $this->Form->control('unit');
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
