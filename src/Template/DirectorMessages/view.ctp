<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DirectorMessage $directorMessage
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Director Message'), ['action' => 'edit', $directorMessage->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Director Message'), ['action' => 'delete', $directorMessage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $directorMessage->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Director Messages'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Director Message'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="directorMessages view large-9 medium-8 columns content">
    <h3><?= h($directorMessage->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Role Type') ?></th>
            <td><?= h($directorMessage->role_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Message By') ?></th>
            <td><?= h($directorMessage->message_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($directorMessage->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($directorMessage->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($directorMessage->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($directorMessage->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($directorMessage->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($directorMessage->edited_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Message') ?></h4>
        <?= $this->Text->autoParagraph(h($directorMessage->message)); ?>
    </div>
</div>
