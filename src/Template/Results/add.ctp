<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Result $result
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Results'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Student Infos'), ['controller' => 'StudentInfos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student Info'), ['controller' => 'StudentInfos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Exam Masters'), ['controller' => 'ExamMasters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Exam Master'), ['controller' => 'ExamMasters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Result Rows'), ['controller' => 'ResultRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Result Row'), ['controller' => 'ResultRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="results form large-9 medium-8 columns content">
    <?= $this->Form->create($result) ?>
    <fieldset>
        <legend><?= __('Add Result') ?></legend>
        <?php
            echo $this->Form->control('student_info_id', ['options' => $studentInfos]);
            echo $this->Form->control('exam_master_id', ['options' => $examMasters]);
            echo $this->Form->control('total');
            echo $this->Form->control('obtain');
            echo $this->Form->control('status');
            echo $this->Form->control('division');
            echo $this->Form->control('grade');
            echo $this->Form->control('percentage');
            echo $this->Form->control('supplementary');
            echo $this->Form->control('fail');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
