<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClassTest $classTest
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $classTest->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $classTest->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Class Tests'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Student Classes'), ['controller' => 'StudentClasses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student Class'), ['controller' => 'StudentClasses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Streams'), ['controller' => 'Streams', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Stream'), ['controller' => 'Streams', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sections'), ['controller' => 'Sections', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Section'), ['controller' => 'Sections', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Class Test Students'), ['controller' => 'ClassTestStudents', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Class Test Student'), ['controller' => 'ClassTestStudents', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="classTests form large-9 medium-8 columns content">
    <?= $this->Form->create($classTest) ?>
    <fieldset>
        <legend><?= __('Edit Class Test') ?></legend>
        <?php
            echo $this->Form->control('session_year_id', ['options' => $sessionYears]);
            echo $this->Form->control('medium_id');
            echo $this->Form->control('student_class_id', ['options' => $studentClasses]);
            echo $this->Form->control('stream_id', ['options' => $streams]);
            echo $this->Form->control('section_id', ['options' => $sections]);
            echo $this->Form->control('subject_id', ['options' => $subjects]);
            echo $this->Form->control('test_date');
            echo $this->Form->control('topic');
            echo $this->Form->control('max_marks');
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
