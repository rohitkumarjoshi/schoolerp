<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department $department
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Department'), ['action' => 'edit', $department->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Department'), ['action' => 'delete', $department->id], ['confirm' => __('Are you sure you want to delete # {0}?', $department->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Departments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Visitors'), ['controller' => 'Visitors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Visitor'), ['controller' => 'Visitors', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="departments view large-9 medium-8 columns content">
    <h3><?= h($department->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($department->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($department->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($department->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($department->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($department->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($department->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($department->edited_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Visitors') ?></h4>
        <?php if (!empty($department->visitors)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Mobile No') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('In Date') ?></th>
                <th scope="col"><?= __('In Time') ?></th>
                <th scope="col"><?= __('Out Date') ?></th>
                <th scope="col"><?= __('Out Time') ?></th>
                <th scope="col"><?= __('Vehicle No') ?></th>
                <th scope="col"><?= __('City Id') ?></th>
                <th scope="col"><?= __('Employee Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Reason') ?></th>
                <th scope="col"><?= __('Remarks') ?></th>
                <th scope="col"><?= __('Id Card') ?></th>
                <th scope="col"><?= __('Id Card No') ?></th>
                <th scope="col"><?= __('Photo') ?></th>
                <th scope="col"><?= __('Visitor Type') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($department->visitors as $visitors): ?>
            <tr>
                <td><?= h($visitors->id) ?></td>
                <td><?= h($visitors->name) ?></td>
                <td><?= h($visitors->mobile_no) ?></td>
                <td><?= h($visitors->address) ?></td>
                <td><?= h($visitors->in_date) ?></td>
                <td><?= h($visitors->in_time) ?></td>
                <td><?= h($visitors->out_date) ?></td>
                <td><?= h($visitors->out_time) ?></td>
                <td><?= h($visitors->vehicle_no) ?></td>
                <td><?= h($visitors->city_id) ?></td>
                <td><?= h($visitors->employee_id) ?></td>
                <td><?= h($visitors->student_id) ?></td>
                <td><?= h($visitors->reason) ?></td>
                <td><?= h($visitors->remarks) ?></td>
                <td><?= h($visitors->id_card) ?></td>
                <td><?= h($visitors->id_card_no) ?></td>
                <td><?= h($visitors->photo) ?></td>
                <td><?= h($visitors->visitor_type) ?></td>
                <td><?= h($visitors->created_on) ?></td>
                <td><?= h($visitors->created_by) ?></td>
                <td><?= h($visitors->edited_on) ?></td>
                <td><?= h($visitors->edited_by) ?></td>
                <td><?= h($visitors->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Visitors', 'action' => 'view', $visitors->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Visitors', 'action' => 'edit', $visitors->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Visitors', 'action' => 'delete', $visitors->id], ['confirm' => __('Are you sure you want to delete # {0}?', $visitors->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
