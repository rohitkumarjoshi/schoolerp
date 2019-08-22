<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ResultRow $resultRow
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Result Rows'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Results'), ['controller' => 'Results', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Result'), ['controller' => 'Results', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Exam Masters'), ['controller' => 'ExamMasters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Exam Master'), ['controller' => 'ExamMasters', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="resultRows form large-9 medium-8 columns content">
    <?= $this->Form->create($resultRow) ?>
    <fieldset>
        <legend><?= __('Add Result Row') ?></legend>
        <?php
            echo $this->Form->control('result_id', ['options' => $results]);
            echo $this->Form->control('subject_id', ['options' => $subjects]);
            echo $this->Form->control('exam_master_id', ['options' => $examMasters]);
            echo $this->Form->control('total');
            echo $this->Form->control('obtain');
            echo $this->Form->control('grade');
            echo $this->Form->control('grace');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
