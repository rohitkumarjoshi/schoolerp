<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EntranceExam $entranceExam
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Entrance Exams'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Entrance Exam Results'), ['controller' => 'EntranceExamResults', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Entrance Exam Result'), ['controller' => 'EntranceExamResults', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="entranceExams form large-9 medium-8 columns content">
    <?= $this->Form->create($entranceExam) ?>
    <fieldset>
        <legend><?= __('Add Entrance Exam') ?></legend>
        <?php
            echo $this->Form->control('session_year_id', ['options' => $sessionYears]);
            echo $this->Form->control('subject_name');
            echo $this->Form->control('minimum_marks');
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
