<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Attendance $attendance
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $attendance->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $attendance->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Attendances'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Student Classes'), ['controller' => 'StudentClasses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student Class'), ['controller' => 'StudentClasses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Streams'), ['controller' => 'Streams', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Stream'), ['controller' => 'Streams', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sections'), ['controller' => 'Sections', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Section'), ['controller' => 'Sections', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Student Infos'), ['controller' => 'StudentInfos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student Info'), ['controller' => 'StudentInfos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="attendances form large-9 medium-8 columns content">
    <?= $this->Form->create($attendance) ?>
    <fieldset>
        <legend><?= __('Edit Attendance') ?></legend>
        <?php
            echo $this->Form->control('session_year_id', ['options' => $sessionYears]);
            echo $this->Form->control('medium_id');
            echo $this->Form->control('student_class_id', ['options' => $studentClasses]);
            echo $this->Form->control('stream_id', ['options' => $streams]);
            echo $this->Form->control('section_id', ['options' => $sections]);
            echo $this->Form->control('student_info_id', ['options' => $studentInfos]);
            echo $this->Form->control('first_half');
            echo $this->Form->control('second_half');
            echo $this->Form->control('attendance_date');
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
