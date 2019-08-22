<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FeeMonth $feeMonth
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Fee Month'), ['action' => 'edit', $feeMonth->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Fee Month'), ['action' => 'delete', $feeMonth->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feeMonth->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Fee Months'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fee Month'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fee Receipt Rows'), ['controller' => 'FeeReceiptRows', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fee Receipt Row'), ['controller' => 'FeeReceiptRows', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fee Type Master Rows'), ['controller' => 'FeeTypeMasterRows', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fee Type Master Row'), ['controller' => 'FeeTypeMasterRows', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="feeMonths view large-9 medium-8 columns content">
    <h3><?= h($feeMonth->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($feeMonth->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($feeMonth->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($feeMonth->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($feeMonth->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($feeMonth->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($feeMonth->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($feeMonth->edited_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Fee Receipt Rows') ?></h4>
        <?php if (!empty($feeMonth->fee_receipt_rows)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Fee Receipt Id') ?></th>
                <th scope="col"><?= __('Fee Type Master Id') ?></th>
                <th scope="col"><?= __('Fee Type Master Row Id') ?></th>
                <th scope="col"><?= __('Fee Type Student Master Id') ?></th>
                <th scope="col"><?= __('Fee Month Id') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($feeMonth->fee_receipt_rows as $feeReceiptRows): ?>
            <tr>
                <td><?= h($feeReceiptRows->id) ?></td>
                <td><?= h($feeReceiptRows->fee_receipt_id) ?></td>
                <td><?= h($feeReceiptRows->fee_type_master_id) ?></td>
                <td><?= h($feeReceiptRows->fee_type_master_row_id) ?></td>
                <td><?= h($feeReceiptRows->fee_type_student_master_id) ?></td>
                <td><?= h($feeReceiptRows->fee_month_id) ?></td>
                <td><?= h($feeReceiptRows->amount) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'FeeReceiptRows', 'action' => 'view', $feeReceiptRows->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'FeeReceiptRows', 'action' => 'edit', $feeReceiptRows->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'FeeReceiptRows', 'action' => 'delete', $feeReceiptRows->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feeReceiptRows->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Fee Type Master Rows') ?></h4>
        <?php if (!empty($feeMonth->fee_type_master_rows)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Fee Type Master Id') ?></th>
                <th scope="col"><?= __('Fee Month Id') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($feeMonth->fee_type_master_rows as $feeTypeMasterRows): ?>
            <tr>
                <td><?= h($feeTypeMasterRows->id) ?></td>
                <td><?= h($feeTypeMasterRows->fee_type_master_id) ?></td>
                <td><?= h($feeTypeMasterRows->fee_month_id) ?></td>
                <td><?= h($feeTypeMasterRows->amount) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'FeeTypeMasterRows', 'action' => 'view', $feeTypeMasterRows->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'FeeTypeMasterRows', 'action' => 'edit', $feeTypeMasterRows->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'FeeTypeMasterRows', 'action' => 'delete', $feeTypeMasterRows->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feeTypeMasterRows->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
