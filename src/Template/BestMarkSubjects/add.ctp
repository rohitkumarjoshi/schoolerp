<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BestMarkSubject $bestMarkSubject
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Best Mark Subjects'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Student Classes'), ['controller' => 'StudentClasses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student Class'), ['controller' => 'StudentClasses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Streams'), ['controller' => 'Streams', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Stream'), ['controller' => 'Streams', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Best Mark Subject Rows'), ['controller' => 'BestMarkSubjectRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Best Mark Subject Row'), ['controller' => 'BestMarkSubjectRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bestMarkSubjects form large-9 medium-8 columns content">
    <?= $this->Form->create($bestMarkSubject) ?>
    <fieldset>
        <legend><?= __('Add Best Mark Subject') ?></legend>
        <?php
            echo $this->Form->control('session_year_id', ['options' => $sessionYears]);
            echo $this->Form->control('student_class_id', ['options' => $studentClasses]);
            echo $this->Form->control('stream_id', ['options' => $streams]);
            echo $this->Form->control('subject_id', ['options' => $subjects]);
            echo $this->Form->control('no_of_best_subject');
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
