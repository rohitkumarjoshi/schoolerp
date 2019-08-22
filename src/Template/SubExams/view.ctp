<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SubExam $subExam
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Sub Exam'), ['action' => 'edit', $subExam->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Sub Exam'), ['action' => 'delete', $subExam->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subExam->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sub Exams'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sub Exam'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exam Masters'), ['controller' => 'ExamMasters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exam Master'), ['controller' => 'ExamMasters', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Student Marks'), ['controller' => 'StudentMarks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Mark'), ['controller' => 'StudentMarks', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="subExams view large-9 medium-8 columns content">
    <h3><?= h($subExam->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Exam Master') ?></th>
            <td><?= $subExam->has('exam_master') ? $this->Html->link($subExam->exam_master->name, ['controller' => 'ExamMasters', 'action' => 'view', $subExam->exam_master->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($subExam->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($subExam->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Max Marks') ?></th>
            <td><?= $this->Number->format($subExam->max_marks) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Student Marks') ?></h4>
        <?php if (!empty($subExam->student_marks)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Session Year Id') ?></th>
                <th scope="col"><?= __('Student Info Id') ?></th>
                <th scope="col"><?= __('Exam Master Id') ?></th>
                <th scope="col"><?= __('Sub Exam Id') ?></th>
                <th scope="col"><?= __('Subject Id') ?></th>
                <th scope="col"><?= __('Student Number') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($subExam->student_marks as $studentMarks): ?>
            <tr>
                <td><?= h($studentMarks->id) ?></td>
                <td><?= h($studentMarks->session_year_id) ?></td>
                <td><?= h($studentMarks->student_info_id) ?></td>
                <td><?= h($studentMarks->exam_master_id) ?></td>
                <td><?= h($studentMarks->sub_exam_id) ?></td>
                <td><?= h($studentMarks->subject_id) ?></td>
                <td><?= h($studentMarks->student_number) ?></td>
                <td><?= h($studentMarks->created_on) ?></td>
                <td><?= h($studentMarks->created_by) ?></td>
                <td><?= h($studentMarks->edited_on) ?></td>
                <td><?= h($studentMarks->edited_by) ?></td>
                <td><?= h($studentMarks->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'StudentMarks', 'action' => 'view', $studentMarks->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'StudentMarks', 'action' => 'edit', $studentMarks->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'StudentMarks', 'action' => 'delete', $studentMarks->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentMarks->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
