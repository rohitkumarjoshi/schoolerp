<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Expense $expense
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Expense'), ['action' => 'edit', $expense->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Expense'), ['action' => 'delete', $expense->id], ['confirm' => __('Are you sure you want to delete # {0}?', $expense->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Expenses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Expense'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Expense Categories'), ['controller' => 'ExpenseCategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Expense Category'), ['controller' => 'ExpenseCategories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Expense Subcategories'), ['controller' => 'ExpenseSubcategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Expense Subcategory'), ['controller' => 'ExpenseSubcategories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vehicles'), ['controller' => 'Vehicles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vehicle'), ['controller' => 'Vehicles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="expenses view large-9 medium-8 columns content">
    <h3><?= h($expense->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Expense Category') ?></th>
            <td><?= $expense->has('expense_category') ? $this->Html->link($expense->expense_category->name, ['controller' => 'ExpenseCategories', 'action' => 'view', $expense->expense_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Expense Subcategory') ?></th>
            <td><?= $expense->has('expense_subcategory') ? $this->Html->link($expense->expense_subcategory->name, ['controller' => 'ExpenseSubcategories', 'action' => 'view', $expense->expense_subcategory->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vehicle') ?></th>
            <td><?= $expense->has('vehicle') ? $this->Html->link($expense->vehicle->vehicle_no, ['controller' => 'Vehicles', 'action' => 'view', $expense->vehicle->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cheque No') ?></th>
            <td><?= h($expense->cheque_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bank Name') ?></th>
            <td><?= h($expense->bank_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($expense->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($expense->amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Expense By') ?></th>
            <td><?= $this->Number->format($expense->expense_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Type Id') ?></th>
            <td><?= $this->Number->format($expense->payment_type_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($expense->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($expense->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Expense Date') ?></th>
            <td><?= h($expense->expense_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cheque Date') ?></th>
            <td><?= h($expense->cheque_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($expense->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($expense->edited_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Remark') ?></h4>
        <?= $this->Text->autoParagraph(h($expense->remark)); ?>
    </div>
    <div class="row">
        <h4><?= __('Bank Remarks') ?></h4>
        <?= $this->Text->autoParagraph(h($expense->bank_remarks)); ?>
    </div>
</div>
