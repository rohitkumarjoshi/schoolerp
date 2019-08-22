<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Assignment $assignment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Assignment'), ['action' => 'edit', $assignment->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Assignment'), ['action' => 'delete', $assignment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assignment->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Assignments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assignment'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Student Classes'), ['controller' => 'StudentClasses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Class'), ['controller' => 'StudentClasses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Streams'), ['controller' => 'Streams', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stream'), ['controller' => 'Streams', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sections'), ['controller' => 'Sections', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Section'), ['controller' => 'Sections', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Assignment Students'), ['controller' => 'AssignmentStudents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assignment Student'), ['controller' => 'AssignmentStudents', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assignments view large-9 medium-8 columns content">
    <h3><?= h($assignment->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Session Year') ?></th>
            <td><?= $assignment->has('session_year') ? $this->Html->link($assignment->session_year->id, ['controller' => 'SessionYears', 'action' => 'view', $assignment->session_year->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Assignment Type') ?></th>
            <td><?= h($assignment->assignment_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Student Class') ?></th>
            <td><?= $assignment->has('student_class') ? $this->Html->link($assignment->student_class->name, ['controller' => 'StudentClasses', 'action' => 'view', $assignment->student_class->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stream') ?></th>
            <td><?= $assignment->has('stream') ? $this->Html->link($assignment->stream->name, ['controller' => 'Streams', 'action' => 'view', $assignment->stream->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Section') ?></th>
            <td><?= $assignment->has('section') ? $this->Html->link($assignment->section->name, ['controller' => 'Sections', 'action' => 'view', $assignment->section->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subject') ?></th>
            <td><?= $assignment->has('subject') ? $this->Html->link($assignment->subject->name, ['controller' => 'Subjects', 'action' => 'view', $assignment->subject->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Topic') ?></th>
            <td><?= h($assignment->topic) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($assignment->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($assignment->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Medium Id') ?></th>
            <td><?= $this->Number->format($assignment->medium_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($assignment->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($assignment->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($assignment->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($assignment->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($assignment->edited_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Document') ?></h4>
        <?= $this->Text->autoParagraph(h($assignment->document)); ?>
    </div>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($assignment->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Assignment Students') ?></h4>
        <?php if (!empty($assignment->assignment_students)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Assignment Id') ?></th>
                <th scope="col"><?= __('Student Info Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($assignment->assignment_students as $assignmentStudents): ?>
            <tr>
                <td><?= h($assignmentStudents->id) ?></td>
                <td><?= h($assignmentStudents->assignment_id) ?></td>
                <td><?= h($assignmentStudents->student_info_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'AssignmentStudents', 'action' => 'view', $assignmentStudents->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'AssignmentStudents', 'action' => 'edit', $assignmentStudents->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'AssignmentStudents', 'action' => 'delete', $assignmentStudents->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assignmentStudents->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
