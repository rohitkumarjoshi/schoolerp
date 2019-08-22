<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StockLedger[]|\Cake\Collection\CollectionInterface $stockLedgers
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Stock Ledger'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="stockLedgers index large-9 medium-8 columns content">
    <h3><?= __('Stock Ledgers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('department_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('edited_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('edited_by') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stockLedgers as $stockLedger): ?>
            <tr>
                <td><?= $this->Number->format($stockLedger->id) ?></td>
                <td><?= $stockLedger->has('item') ? $this->Html->link($stockLedger->item->name, ['controller' => 'Items', 'action' => 'view', $stockLedger->item->id]) : '' ?></td>
                <td><?= $stockLedger->has('department') ? $this->Html->link($stockLedger->department->name, ['controller' => 'Departments', 'action' => 'view', $stockLedger->department->id]) : '' ?></td>
                <td><?= h($stockLedger->date) ?></td>
                <td><?= h($stockLedger->status) ?></td>
                <td><?= h($stockLedger->created_on) ?></td>
                <td><?= $this->Number->format($stockLedger->created_by) ?></td>
                <td><?= h($stockLedger->edited_on) ?></td>
                <td><?= $this->Number->format($stockLedger->edited_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $stockLedger->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $stockLedger->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $stockLedger->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stockLedger->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
