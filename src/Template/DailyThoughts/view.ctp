<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DailyThought $dailyThought
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Daily Thought'), ['action' => 'edit', $dailyThought->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Daily Thought'), ['action' => 'delete', $dailyThought->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dailyThought->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Daily Thoughts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Daily Thought'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="dailyThoughts view large-9 medium-8 columns content">
    <h3><?= h($dailyThought->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Role Type') ?></th>
            <td><?= h($dailyThought->role_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($dailyThought->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($dailyThought->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($dailyThought->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($dailyThought->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($dailyThought->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($dailyThought->edited_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($dailyThought->description)); ?>
    </div>
</div>
