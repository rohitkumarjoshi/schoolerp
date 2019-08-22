<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AchivementCategory $achivementCategory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $achivementCategory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $achivementCategory->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Achivement Categories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Student Achivements'), ['controller' => 'StudentAchivements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student Achivement'), ['controller' => 'StudentAchivements', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="achivementCategories form large-9 medium-8 columns content">
    <?= $this->Form->create($achivementCategory) ?>
    <fieldset>
        <legend><?= __('Edit Achivement Category') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('created_on');
            echo $this->Form->control('created_by');
            echo $this->Form->control('edited_on');
            echo $this->Form->control('edited_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
