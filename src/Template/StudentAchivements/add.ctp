<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StudentAchivement $studentAchivement
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Student Achivements'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Achivement Categories'), ['controller' => 'AchivementCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Achivement Category'), ['controller' => 'AchivementCategories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="studentAchivements form large-9 medium-8 columns content">
    <?= $this->Form->create($studentAchivement) ?>
    <fieldset>
        <legend><?= __('Add Student Achivement') ?></legend>
        <?php
            echo $this->Form->control('session_year_id', ['options' => $sessionYears]);
            echo $this->Form->control('achivement_category_id', ['options' => $achivementCategories]);
            echo $this->Form->control('achivement_type');
            echo $this->Form->control('student_id', ['options' => $students]);
            echo $this->Form->control('description');
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
