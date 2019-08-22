<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ExamMaxMark $examMaxMark
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Exam Max Mark'), ['action' => 'edit', $examMaxMark->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Exam Max Mark'), ['action' => 'delete', $examMaxMark->id], ['confirm' => __('Are you sure you want to delete # {0}?', $examMaxMark->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Exam Max Marks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exam Max Mark'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exam Masters'), ['controller' => 'ExamMasters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exam Master'), ['controller' => 'ExamMasters', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="examMaxMarks view large-9 medium-8 columns content">
    <h3><?= h($examMaxMark->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Exam Master') ?></th>
            <td><?= $examMaxMark->has('exam_master') ? $this->Html->link($examMaxMark->exam_master->name, ['controller' => 'ExamMasters', 'action' => 'view', $examMaxMark->exam_master->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subject') ?></th>
            <td><?= $examMaxMark->has('subject') ? $this->Html->link($examMaxMark->subject->name, ['controller' => 'Subjects', 'action' => 'view', $examMaxMark->subject->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($examMaxMark->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($examMaxMark->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Max Marks') ?></th>
            <td><?= $this->Number->format($examMaxMark->max_marks) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($examMaxMark->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($examMaxMark->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($examMaxMark->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($examMaxMark->edited_on) ?></td>
        </tr>
    </table>
</div>
