<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NoticeCategory $noticeCategory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $noticeCategory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $noticeCategory->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Notice Categories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Notices'), ['controller' => 'Notices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Notice'), ['controller' => 'Notices', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="noticeCategories form large-9 medium-8 columns content">
    <?= $this->Form->create($noticeCategory) ?>
    <fieldset>
        <legend><?= __('Edit Notice Category') ?></legend>
        <?php
            echo $this->Form->control('name');
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
