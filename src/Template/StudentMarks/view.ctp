<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StudentMark $studentMark
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Student Mark'), ['action' => 'edit', $studentMark->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Student Mark'), ['action' => 'delete', $studentMark->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentMark->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Student Marks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Mark'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Student Infos'), ['controller' => 'StudentInfos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Info'), ['controller' => 'StudentInfos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exam Masters'), ['controller' => 'ExamMasters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exam Master'), ['controller' => 'ExamMasters', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="studentMarks view large-9 medium-8 columns content">
    <h3><?= h($studentMark->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Session Year') ?></th>
            <td><?= $studentMark->has('session_year') ? $this->Html->link($studentMark->session_year->id, ['controller' => 'SessionYears', 'action' => 'view', $studentMark->session_year->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Student Info') ?></th>
            <td><?= $studentMark->has('student_info') ? $this->Html->link($studentMark->student_info->id, ['controller' => 'StudentInfos', 'action' => 'view', $studentMark->student_info->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Exam Master') ?></th>
            <td><?= $studentMark->has('exam_master') ? $this->Html->link($studentMark->exam_master->name, ['controller' => 'ExamMasters', 'action' => 'view', $studentMark->exam_master->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subject') ?></th>
            <td><?= $studentMark->has('subject') ? $this->Html->link($studentMark->subject->name, ['controller' => 'Subjects', 'action' => 'view', $studentMark->subject->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Student Number') ?></th>
            <td><?= h($studentMark->student_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($studentMark->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($studentMark->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($studentMark->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($studentMark->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($studentMark->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($studentMark->edited_on) ?></td>
        </tr>
    </table>
</div>
