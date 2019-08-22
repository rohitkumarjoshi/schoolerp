<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FeeReceiptRow[]|\Cake\Collection\CollectionInterface $feeReceiptRows
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Fee Receipt Row'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fee Receipts'), ['controller' => 'FeeReceipts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fee Receipt'), ['controller' => 'FeeReceipts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fee Type Masters'), ['controller' => 'FeeTypeMasters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fee Type Master'), ['controller' => 'FeeTypeMasters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fee Type Master Rows'), ['controller' => 'FeeTypeMasterRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fee Type Master Row'), ['controller' => 'FeeTypeMasterRows', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fee Type Student Masters'), ['controller' => 'FeeTypeStudentMasters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fee Type Student Master'), ['controller' => 'FeeTypeStudentMasters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fee Months'), ['controller' => 'FeeMonths', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fee Month'), ['controller' => 'FeeMonths', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="feeReceiptRows index large-9 medium-8 columns content">
    <h3><?= __('Fee Receipt Rows') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fee_receipt_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fee_type_master_row_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fee_type_student_master_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fee_month_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($feeReceiptRows as $feeReceiptRow): ?>
            <tr>
                <td><?= $this->Number->format($feeReceiptRow->id) ?></td>
                <td><?= $feeReceiptRow->has('fee_receipt') ? $this->Html->link($feeReceiptRow->fee_receipt->id, ['controller' => 'FeeReceipts', 'action' => 'view', $feeReceiptRow->fee_receipt->id]) : '' ?></td>
                <td><?= $feeReceiptRow->has('fee_type_master_row') ? $this->Html->link($feeReceiptRow->fee_type_master_row->id, ['controller' => 'FeeTypeMasterRows', 'action' => 'view', $feeReceiptRow->fee_type_master_row->id]) : '' ?></td>
                <td><?= $feeReceiptRow->has('fee_type_student_master') ? $this->Html->link($feeReceiptRow->fee_type_student_master->id, ['controller' => 'FeeTypeStudentMasters', 'action' => 'view', $feeReceiptRow->fee_type_student_master->id]) : '' ?></td>
                <td><?= $feeReceiptRow->has('fee_month') ? $this->Html->link($feeReceiptRow->fee_month->name, ['controller' => 'FeeMonths', 'action' => 'view', $feeReceiptRow->fee_month->id]) : '' ?></td>
                <td><?= $this->Number->format($feeReceiptRow->amount) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $feeReceiptRow->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $feeReceiptRow->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $feeReceiptRow->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feeReceiptRow->id)]) ?>
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
