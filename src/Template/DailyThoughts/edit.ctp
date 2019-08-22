<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DailyThought $dailyThought
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $dailyThought->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $dailyThought->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Daily Thoughts'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="dailyThoughts form large-9 medium-8 columns content">
    <?= $this->Form->create($dailyThought) ?>
    <fieldset>
        <legend><?= __('Edit Daily Thought') ?></legend>
        <?php
            echo $this->Form->control('role_type');
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
