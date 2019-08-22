<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TimeTablePeriod $timeTablePeriod
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $timeTablePeriod->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $timeTablePeriod->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Time Table Periods'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Student Classes'), ['controller' => 'StudentClasses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student Class'), ['controller' => 'StudentClasses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Streams'), ['controller' => 'Streams', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Stream'), ['controller' => 'Streams', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sections'), ['controller' => 'Sections', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Section'), ['controller' => 'Sections', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="timeTablePeriods form large-9 medium-8 columns content">
    <?= $this->Form->create($timeTablePeriod) ?>
    <fieldset>
        <legend><?= __('Edit Time Table Period') ?></legend>
        <?php
            echo $this->Form->control('medium_id');
            echo $this->Form->control('student_class_id', ['options' => $studentClasses]);
            echo $this->Form->control('stream_id', ['options' => $streams, 'empty' => true]);
            echo $this->Form->control('section_id', ['options' => $sections, 'empty' => true]);
            echo $this->Form->control('subject_id', ['options' => $subjects]);
            echo $this->Form->control('time_from');
            echo $this->Form->control('time_to');
            echo $this->Form->control('day');
            echo $this->Form->control('employee_id', ['options' => $employees]);
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
