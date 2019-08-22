<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StudentRedDiary $studentRedDiary
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $studentRedDiary->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $studentRedDiary->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Student Red Diaries'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="studentRedDiaries form large-9 medium-8 columns content">
    <?= $this->Form->create($studentRedDiary) ?>
    <fieldset>
        <legend><?= __('Edit Student Red Diary') ?></legend>
        <?php
            echo $this->Form->control('student_id', ['options' => $students]);
            echo $this->Form->control('session_year_id', ['options' => $sessionYears]);
            echo $this->Form->control('reason');
            echo $this->Form->control('description');
            echo $this->Form->control('punished_by');
            echo $this->Form->control('punished_from');
            echo $this->Form->control('punished_to');
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
