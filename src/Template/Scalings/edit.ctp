<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Scaling $scaling
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $scaling->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $scaling->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Scalings'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="scalings form large-9 medium-8 columns content">
    <?= $this->Form->create($scaling) ?>
    <fieldset>
        <legend><?= __('Edit Scaling') ?></legend>
        <?php
            echo $this->Form->control('session_year_id', ['options' => $sessionYears]);
            echo $this->Form->control('subject_id', ['options' => $subjects]);
            echo $this->Form->control('scale_no');
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
