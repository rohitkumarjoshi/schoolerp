<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Poll $poll
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $poll->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $poll->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Polls'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Poll Results'), ['controller' => 'PollResults', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Poll Result'), ['controller' => 'PollResults', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Poll Rows'), ['controller' => 'PollRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Poll Row'), ['controller' => 'PollRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="polls form large-9 medium-8 columns content">
    <?= $this->Form->create($poll) ?>
    <fieldset>
        <legend><?= __('Edit Poll') ?></legend>
        <?php
            echo $this->Form->control('question');
            echo $this->Form->control('poll_type');
            echo $this->Form->control('created_on');
            echo $this->Form->control('created_by');
            echo $this->Form->control('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
