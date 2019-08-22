<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FeeReceiptRow $feeReceiptRow
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $feeReceiptRow->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $feeReceiptRow->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Fee Receipt Rows'), ['action' => 'index']) ?></li>
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
<div class="feeReceiptRows form large-9 medium-8 columns content">
    <?= $this->Form->create($feeReceiptRow) ?>
    <fieldset>
        <legend><?= __('Edit Fee Receipt Row') ?></legend>
        <?php
            echo $this->Form->control('fee_receipt_id', ['options' => $feeReceipts]);
            echo $this->Form->control('fee_type_master_row_id', ['options' => $feeTypeMasterRows, 'empty' => true]);
            echo $this->Form->control('fee_type_student_master_id', ['options' => $feeTypeStudentMasters, 'empty' => true]);
            echo $this->Form->control('fee_month_id', ['options' => $feeMonths, 'empty' => true]);
            echo $this->Form->control('amount');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
