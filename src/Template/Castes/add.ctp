<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Caste $caste
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Castes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Student Infos'), ['controller' => 'StudentInfos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student Info'), ['controller' => 'StudentInfos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="castes form large-9 medium-8 columns content">
    <?= $this->Form->create($caste) ?>
    <fieldset>
        <legend><?= __('Add Caste') ?></legend>
        <?php
            echo $this->Form->control('name');
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
