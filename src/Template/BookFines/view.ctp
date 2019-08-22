<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BookFine $bookFine
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Book Fine'), ['action' => 'edit', $bookFine->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Book Fine'), ['action' => 'delete', $bookFine->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bookFine->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Book Fines'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Book Fine'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="bookFines view large-9 medium-8 columns content">
    <h3><?= h($bookFine->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Fine For') ?></th>
            <td><?= h($bookFine->fine_for) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($bookFine->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fine After Days') ?></th>
            <td><?= $this->Number->format($bookFine->fine_after_days) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fine Amount Per Day') ?></th>
            <td><?= $this->Number->format($bookFine->fine_amount_per_day) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($bookFine->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($bookFine->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($bookFine->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($bookFine->edited_on) ?></td>
        </tr>
    </table>
</div>
