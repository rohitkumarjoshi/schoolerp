<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SubExam $subExam
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $subExam->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $subExam->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Sub Exams'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Exam Masters'), ['controller' => 'ExamMasters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Exam Master'), ['controller' => 'ExamMasters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Student Marks'), ['controller' => 'StudentMarks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student Mark'), ['controller' => 'StudentMarks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="subExams form large-9 medium-8 columns content">
    <?= $this->Form->create($subExam) ?>
    <fieldset>
        <legend><?= __('Edit Sub Exam') ?></legend>
        <?php
            echo $this->Form->control('exam_master_id', ['options' => $examMasters]);
            echo $this->Form->control('name');
            echo $this->Form->control('max_marks');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
