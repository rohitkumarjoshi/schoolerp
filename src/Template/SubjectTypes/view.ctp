<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SubjectType $subjectType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Subject Type'), ['action' => 'edit', $subjectType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Subject Type'), ['action' => 'delete', $subjectType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subjectType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Subject Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject Type'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="subjectTypes view large-9 medium-8 columns content">
    <h3><?= h($subjectType->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Session Year') ?></th>
            <td><?= $subjectType->has('session_year') ? $this->Html->link($subjectType->session_year->id, ['controller' => 'SessionYears', 'action' => 'view', $subjectType->session_year->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($subjectType->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($subjectType->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($subjectType->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($subjectType->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($subjectType->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($subjectType->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($subjectType->edited_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Detail') ?></h4>
        <?= $this->Text->autoParagraph(h($subjectType->detail)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Subjects') ?></h4>
        <?php if (!empty($subjectType->subjects)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Session Year Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Student Class Id') ?></th>
                <th scope="col"><?= __('Stream Id') ?></th>
                <th scope="col"><?= __('Parent Id') ?></th>
                <th scope="col"><?= __('Lft') ?></th>
                <th scope="col"><?= __('Rght') ?></th>
                <th scope="col"><?= __('Elective') ?></th>
                <th scope="col"><?= __('Grade Type') ?></th>
                <th scope="col"><?= __('Subject Type Id') ?></th>
                <th scope="col"><?= __('Order Type') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($subjectType->subjects as $subjects): ?>
            <tr>
                <td><?= h($subjects->id) ?></td>
                <td><?= h($subjects->session_year_id) ?></td>
                <td><?= h($subjects->name) ?></td>
                <td><?= h($subjects->student_class_id) ?></td>
                <td><?= h($subjects->stream_id) ?></td>
                <td><?= h($subjects->parent_id) ?></td>
                <td><?= h($subjects->lft) ?></td>
                <td><?= h($subjects->rght) ?></td>
                <td><?= h($subjects->elective) ?></td>
                <td><?= h($subjects->grade_type) ?></td>
                <td><?= h($subjects->subject_type_id) ?></td>
                <td><?= h($subjects->order_type) ?></td>
                <td><?= h($subjects->created_on) ?></td>
                <td><?= h($subjects->created_by) ?></td>
                <td><?= h($subjects->edited_on) ?></td>
                <td><?= h($subjects->edited_by) ?></td>
                <td><?= h($subjects->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Subjects', 'action' => 'view', $subjects->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Subjects', 'action' => 'edit', $subjects->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Subjects', 'action' => 'delete', $subjects->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subjects->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
