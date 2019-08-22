<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FeeReceiptRow $feeReceiptRow
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Fee Receipt Row'), ['action' => 'edit', $feeReceiptRow->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Fee Receipt Row'), ['action' => 'delete', $feeReceiptRow->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feeReceiptRow->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Fee Receipt Rows'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fee Receipt Row'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fee Receipts'), ['controller' => 'FeeReceipts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fee Receipt'), ['controller' => 'FeeReceipts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fee Type Masters'), ['controller' => 'FeeTypeMasters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fee Type Master'), ['controller' => 'FeeTypeMasters', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fee Type Master Rows'), ['controller' => 'FeeTypeMasterRows', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fee Type Master Row'), ['controller' => 'FeeTypeMasterRows', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fee Type Student Masters'), ['controller' => 'FeeTypeStudentMasters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fee Type Student Master'), ['controller' => 'FeeTypeStudentMasters', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fee Months'), ['controller' => 'FeeMonths', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fee Month'), ['controller' => 'FeeMonths', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="feeReceiptRows view large-9 medium-8 columns content">
    <h3><?= h($feeReceiptRow->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Fee Receipt') ?></th>
            <td><?= $feeReceiptRow->has('fee_receipt') ? $this->Html->link($feeReceiptRow->fee_receipt->id, ['controller' => 'FeeReceipts', 'action' => 'view', $feeReceiptRow->fee_receipt->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fee Type Master Row') ?></th>
            <td><?= $feeReceiptRow->has('fee_type_master_row') ? $this->Html->link($feeReceiptRow->fee_type_master_row->id, ['controller' => 'FeeTypeMasterRows', 'action' => 'view', $feeReceiptRow->fee_type_master_row->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fee Type Student Master') ?></th>
            <td><?= $feeReceiptRow->has('fee_type_student_master') ? $this->Html->link($feeReceiptRow->fee_type_student_master->id, ['controller' => 'FeeTypeStudentMasters', 'action' => 'view', $feeReceiptRow->fee_type_student_master->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fee Month') ?></th>
            <td><?= $feeReceiptRow->has('fee_month') ? $this->Html->link($feeReceiptRow->fee_month->name, ['controller' => 'FeeMonths', 'action' => 'view', $feeReceiptRow->fee_month->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($feeReceiptRow->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($feeReceiptRow->amount) ?></td>
        </tr>
    </table>
</div>
