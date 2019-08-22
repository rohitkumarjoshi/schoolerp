<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ExamMaxMark $examMaxMark
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $examMaxMark->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $examMaxMark->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Exam Max Marks'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Exam Masters'), ['controller' => 'ExamMasters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Exam Master'), ['controller' => 'ExamMasters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="examMaxMarks form large-9 medium-8 columns content">
    <?= $this->Form->create($examMaxMark) ?>
    <fieldset>
        <legend><?= __('Edit Exam Max Mark') ?></legend>
        <?php
            echo $this->Form->control('exam_master_id', ['options' => $examMasters]);
            echo $this->Form->control('subject_id', ['options' => $subjects, 'empty' => true]);
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
