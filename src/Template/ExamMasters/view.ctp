<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ExamMaster $examMaster
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Exam Master'), ['action' => 'edit', $examMaster->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Exam Master'), ['action' => 'delete', $examMaster->id], ['confirm' => __('Are you sure you want to delete # {0}?', $examMaster->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Exam Masters'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exam Master'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Student Classes'), ['controller' => 'StudentClasses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Class'), ['controller' => 'StudentClasses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Streams'), ['controller' => 'Streams', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stream'), ['controller' => 'Streams', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parent Exam Masters'), ['controller' => 'ExamMasters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parent Exam Master'), ['controller' => 'ExamMasters', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Child Exam Masters'), ['controller' => 'ExamMasters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Child Exam Master'), ['controller' => 'ExamMasters', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Student Marks'), ['controller' => 'StudentMarks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Mark'), ['controller' => 'StudentMarks', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="examMasters view large-9 medium-8 columns content">
    <h3><?= h($examMaster->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Session Year') ?></th>
            <td><?= $examMaster->has('session_year') ? $this->Html->link($examMaster->session_year->id, ['controller' => 'SessionYears', 'action' => 'view', $examMaster->session_year->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($examMaster->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Student Class') ?></th>
            <td><?= $examMaster->has('student_class') ? $this->Html->link($examMaster->student_class->name, ['controller' => 'StudentClasses', 'action' => 'view', $examMaster->student_class->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stream') ?></th>
            <td><?= $examMaster->has('stream') ? $this->Html->link($examMaster->stream->name, ['controller' => 'Streams', 'action' => 'view', $examMaster->stream->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parent Exam Master') ?></th>
            <td><?= $examMaster->has('parent_exam_master') ? $this->Html->link($examMaster->parent_exam_master->name, ['controller' => 'ExamMasters', 'action' => 'view', $examMaster->parent_exam_master->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($examMaster->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($examMaster->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lft') ?></th>
            <td><?= $this->Number->format($examMaster->lft) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rght') ?></th>
            <td><?= $this->Number->format($examMaster->rght) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Order Number') ?></th>
            <td><?= $this->Number->format($examMaster->order_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($examMaster->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($examMaster->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($examMaster->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($examMaster->edited_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Exam Masters') ?></h4>
        <?php if (!empty($examMaster->child_exam_masters)): ?>
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
                <th scope="col"><?= __('Order Number') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($examMaster->child_exam_masters as $childExamMasters): ?>
            <tr>
                <td><?= h($childExamMasters->id) ?></td>
                <td><?= h($childExamMasters->session_year_id) ?></td>
                <td><?= h($childExamMasters->name) ?></td>
                <td><?= h($childExamMasters->student_class_id) ?></td>
                <td><?= h($childExamMasters->stream_id) ?></td>
                <td><?= h($childExamMasters->parent_id) ?></td>
                <td><?= h($childExamMasters->lft) ?></td>
                <td><?= h($childExamMasters->rght) ?></td>
                <td><?= h($childExamMasters->order_number) ?></td>
                <td><?= h($childExamMasters->created_on) ?></td>
                <td><?= h($childExamMasters->created_by) ?></td>
                <td><?= h($childExamMasters->edited_on) ?></td>
                <td><?= h($childExamMasters->edited_by) ?></td>
                <td><?= h($childExamMasters->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ExamMasters', 'action' => 'view', $childExamMasters->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ExamMasters', 'action' => 'edit', $childExamMasters->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ExamMasters', 'action' => 'delete', $childExamMasters->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childExamMasters->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Student Marks') ?></h4>
        <?php if (!empty($examMaster->student_marks)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Session Year Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Student Info Id') ?></th>
                <th scope="col"><?= __('Exam Master Id') ?></th>
                <th scope="col"><?= __('Subject Id') ?></th>
                <th scope="col"><?= __('Student Number') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($examMaster->student_marks as $studentMarks): ?>
            <tr>
                <td><?= h($studentMarks->id) ?></td>
                <td><?= h($studentMarks->session_year_id) ?></td>
                <td><?= h($studentMarks->student_id) ?></td>
                <td><?= h($studentMarks->student_info_id) ?></td>
                <td><?= h($studentMarks->exam_master_id) ?></td>
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
