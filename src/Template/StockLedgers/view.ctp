<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StockLedger $stockLedger
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Stock Ledger'), ['action' => 'edit', $stockLedger->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Stock Ledger'), ['action' => 'delete', $stockLedger->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stockLedger->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Stock Ledgers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stock Ledger'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="stockLedgers view large-9 medium-8 columns content">
    <h3><?= h($stockLedger->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Item') ?></th>
            <td><?= $stockLedger->has('item') ? $this->Html->link($stockLedger->item->name, ['controller' => 'Items', 'action' => 'view', $stockLedger->item->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Department') ?></th>
            <td><?= $stockLedger->has('department') ? $this->Html->link($stockLedger->department->name, ['controller' => 'Departments', 'action' => 'view', $stockLedger->department->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($stockLedger->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($stockLedger->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($stockLedger->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($stockLedger->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($stockLedger->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($stockLedger->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($stockLedger->edited_on) ?></td>
        </tr>
    </table>
</div>
