<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MonthMapping $monthMapping
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $monthMapping->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $monthMapping->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Month Mappings'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Student Classes'), ['controller' => 'StudentClasses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student Class'), ['controller' => 'StudentClasses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Streams'), ['controller' => 'Streams', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Stream'), ['controller' => 'Streams', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="monthMappings form large-9 medium-8 columns content">
    <?= $this->Form->create($monthMapping) ?>
    <fieldset>
        <legend><?= __('Edit Month Mapping') ?></legend>
        <?php
            echo $this->Form->control('session_year_id', ['options' => $sessionYears]);
            echo $this->Form->control('student_class_id', ['options' => $studentClasses]);
            echo $this->Form->control('medium_id');
            echo $this->Form->control('stream_id', ['options' => $streams]);
            echo $this->Form->control('april');
            echo $this->Form->control('may');
            echo $this->Form->control('june');
            echo $this->Form->control('july');
            echo $this->Form->control('august');
            echo $this->Form->control('september');
            echo $this->Form->control('october');
            echo $this->Form->control('november');
            echo $this->Form->control('december');
            echo $this->Form->control('january');
            echo $this->Form->control('february');
            echo $this->Form->control('march');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
