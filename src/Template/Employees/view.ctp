<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Employee'), ['action' => 'edit', $employee->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Employee'), ['action' => 'delete', $employee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employee->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Genders'), ['controller' => 'Genders', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Gender'), ['controller' => 'Genders', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Hostels'), ['controller' => 'Hostels', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hostel'), ['controller' => 'Hostels', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Item Issue Returns'), ['controller' => 'ItemIssueReturns', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Issue Return'), ['controller' => 'ItemIssueReturns', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="employees view large-9 medium-8 columns content">
    <h3><?= h($employee->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Session Year') ?></th>
            <td><?= $employee->has('session_year') ? $this->Html->link($employee->session_year->session_name, ['controller' => 'SessionYears', 'action' => 'view', $employee->session_year->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($employee->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Marital Status') ?></th>
            <td><?= h($employee->marital_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gender') ?></th>
            <td><?= $employee->has('gender') ? $this->Html->link($employee->gender->name, ['controller' => 'Genders', 'action' => 'view', $employee->gender->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= $employee->has('city') ? $this->Html->link($employee->city->name, ['controller' => 'Cities', 'action' => 'view', $employee->city->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <td><?= $employee->has('state') ? $this->Html->link($employee->state->name, ['controller' => 'States', 'action' => 'view', $employee->state->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($employee->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($employee->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Role Id') ?></th>
            <td><?= $this->Number->format($employee->role_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dob') ?></th>
            <td><?= h($employee->dob) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Parmanent Address') ?></h4>
        <?= $this->Text->autoParagraph(h($employee->parmanent_address)); ?>
    </div>
    <div class="row">
        <h4><?= __('Correspondence Address') ?></h4>
        <?= $this->Text->autoParagraph(h($employee->correspondence_address)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Hostels') ?></h4>
        <?php if (!empty($employee->hostels)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Hostel Name') ?></th>
                <th scope="col"><?= __('Warden Id') ?></th>
                <th scope="col"><?= __('Assistant Warden Id') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('No Of Rooms') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($employee->hostels as $hostels): ?>
            <tr>
                <td><?= h($hostels->id) ?></td>
                <td><?= h($hostels->hostel_name) ?></td>
                <td><?= h($hostels->warden_id) ?></td>
                <td><?= h($hostels->assistant_warden_id) ?></td>
                <td><?= h($hostels->address) ?></td>
                <td><?= h($hostels->no_of_rooms) ?></td>
                <td><?= h($hostels->created_on) ?></td>
                <td><?= h($hostels->created_by) ?></td>
                <td><?= h($hostels->edited_on) ?></td>
                <td><?= h($hostels->edited_by) ?></td>
                <td><?= h($hostels->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Hostels', 'action' => 'view', $hostels->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Hostels', 'action' => 'edit', $hostels->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Hostels', 'action' => 'delete', $hostels->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hostels->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Item Issue Returns') ?></h4>
        <?php if (!empty($employee->item_issue_returns)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Session Year Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Employee Id') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Transaction Date') ?></th>
                <th scope="col"><?= __('Grand Total') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($employee->item_issue_returns as $itemIssueReturns): ?>
            <tr>
                <td><?= h($itemIssueReturns->id) ?></td>
                <td><?= h($itemIssueReturns->session_year_id) ?></td>
                <td><?= h($itemIssueReturns->student_id) ?></td>
                <td><?= h($itemIssueReturns->employee_id) ?></td>
                <td><?= h($itemIssueReturns->status) ?></td>
                <td><?= h($itemIssueReturns->transaction_date) ?></td>
                <td><?= h($itemIssueReturns->grand_total) ?></td>
                <td><?= h($itemIssueReturns->created_on) ?></td>
                <td><?= h($itemIssueReturns->created_by) ?></td>
                <td><?= h($itemIssueReturns->edited_on) ?></td>
                <td><?= h($itemIssueReturns->edited_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ItemIssueReturns', 'action' => 'view', $itemIssueReturns->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ItemIssueReturns', 'action' => 'edit', $itemIssueReturns->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ItemIssueReturns', 'action' => 'delete', $itemIssueReturns->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemIssueReturns->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
