<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LibraryStudentInOut $libraryStudentInOut
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $libraryStudentInOut->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $libraryStudentInOut->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Library Student In Outs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="libraryStudentInOuts form large-9 medium-8 columns content">
    <?= $this->Form->create($libraryStudentInOut) ?>
    <fieldset>
        <legend><?= __('Edit Library Student In Out') ?></legend>
        <?php
            echo $this->Form->control('student_id', ['options' => $students]);
            echo $this->Form->control('session_year_id', ['options' => $sessionYears]);
            echo $this->Form->control('in_date');
            echo $this->Form->control('in_time');
            echo $this->Form->control('out_date');
            echo $this->Form->control('out_time');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
