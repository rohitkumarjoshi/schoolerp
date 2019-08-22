<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DirectorMessage $directorMessage
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Director Messages'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="directorMessages form large-9 medium-8 columns content">
    <?= $this->Form->create($directorMessage) ?>
    <fieldset>
        <legend><?= __('Add Director Message') ?></legend>
        <?php
            echo $this->Form->control('role_type');
            echo $this->Form->control('message');
            echo $this->Form->control('message_by');
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
