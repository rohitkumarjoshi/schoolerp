<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FeeReceipt[]|\Cake\Collection\CollectionInterface $feeReceipts
 */
?>
<!--<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Fee Receipt'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fee Type Receipts'), ['controller' => 'FeeTypeReceipts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fee Type Receipt'), ['controller' => 'FeeTypeReceipts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Student Infos'), ['controller' => 'StudentInfos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student Info'), ['controller' => 'StudentInfos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fee Receipt Rows'), ['controller' => 'FeeReceiptRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fee Receipt Row'), ['controller' => 'FeeReceiptRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="feeReceipts index large-9 medium-8 columns content">
    <h3><?= __('Fee Receipts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('session_year_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fee_type_master_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('enquiry_form_student_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('student_info_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('receipt_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fine_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('concession_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_method') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cheque_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cheque_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('transaction_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('receipt_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('edited_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('edited_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($feeReceipts as $feeReceipt): ?>
            <tr>
                <td><?= $this->Number->format($feeReceipt->id) ?></td>
                <td><?= $feeReceipt->has('session_year') ? $this->Html->link($feeReceipt->session_year->id, ['controller' => 'SessionYears', 'action' => 'view', $feeReceipt->session_year->id]) : '' ?></td>
                <td><?= $this->Number->format($feeReceipt->fee_type_master_id) ?></td>
                <td><?= $this->Number->format($feeReceipt->enquiry_form_student_id) ?></td>
                <td><?= $feeReceipt->has('student_info') ? $this->Html->link($feeReceipt->student_info->id, ['controller' => 'StudentInfos', 'action' => 'view', $feeReceipt->student_info->id]) : '' ?></td>
                <td><?= $this->Number->format($feeReceipt->receipt_no) ?></td>
                <td><?= $this->Number->format($feeReceipt->amount) ?></td>
                <td><?= $this->Number->format($feeReceipt->fine_amount) ?></td>
                <td><?= $this->Number->format($feeReceipt->concession_amount) ?></td>
                <td><?= $this->Number->format($feeReceipt->total_amount) ?></td>
                <td><?= h($feeReceipt->payment_type) ?></td>
                <td><?= h($feeReceipt->payment_method) ?></td>
                <td><?= h($feeReceipt->cheque_no) ?></td>
                <td><?= h($feeReceipt->cheque_date) ?></td>
                <td><?= h($feeReceipt->transaction_no) ?></td>
                <td><?= h($feeReceipt->receipt_date) ?></td>
                <td><?= h($feeReceipt->created_on) ?></td>
                <td><?= $this->Number->format($feeReceipt->created_by) ?></td>
                <td><?= h($feeReceipt->edited_on) ?></td>
                <td><?= $this->Number->format($feeReceipt->edited_by) ?></td>
                <td><?= h($feeReceipt->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $feeReceipt->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $feeReceipt->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $feeReceipt->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feeReceipt->id)]) ?>
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
-->