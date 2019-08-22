<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BestMarkSubjectRow $bestMarkSubjectRow
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Best Mark Subject Rows'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Best Mark Subjects'), ['controller' => 'BestMarkSubjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Best Mark Subject'), ['controller' => 'BestMarkSubjects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Exam Masters'), ['controller' => 'ExamMasters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Exam Master'), ['controller' => 'ExamMasters', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bestMarkSubjectRows form large-9 medium-8 columns content">
    <?= $this->Form->create($bestMarkSubjectRow) ?>
    <fieldset>
        <legend><?= __('Add Best Mark Subject Row') ?></legend>
        <?php
            echo $this->Form->control('best_mark_subject_id', ['options' => $bestMarkSubjects]);
            echo $this->Form->control('exam_master_id', ['options' => $examMasters]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
