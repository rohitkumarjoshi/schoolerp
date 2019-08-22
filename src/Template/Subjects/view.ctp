<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Subject $subject
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Subject'), ['action' => 'edit', $subject->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Subject'), ['action' => 'delete', $subject->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subject->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Student Classes'), ['controller' => 'StudentClasses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Class'), ['controller' => 'StudentClasses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Streams'), ['controller' => 'Streams', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stream'), ['controller' => 'Streams', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parent Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parent Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subject Types'), ['controller' => 'SubjectTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject Type'), ['controller' => 'SubjectTypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Books'), ['controller' => 'Books', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Book'), ['controller' => 'Books', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Child Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Child Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="subjects view large-9 medium-8 columns content">
    <h3><?= h($subject->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Session Year') ?></th>
            <td><?= $subject->has('session_year') ? $this->Html->link($subject->session_year->id, ['controller' => 'SessionYears', 'action' => 'view', $subject->session_year->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($subject->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Student Class') ?></th>
            <td><?= $subject->has('student_class') ? $this->Html->link($subject->student_class->name, ['controller' => 'StudentClasses', 'action' => 'view', $subject->student_class->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stream') ?></th>
            <td><?= $subject->has('stream') ? $this->Html->link($subject->stream->name, ['controller' => 'Streams', 'action' => 'view', $subject->stream->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parent Subject') ?></th>
            <td><?= $subject->has('parent_subject') ? $this->Html->link($subject->parent_subject->name, ['controller' => 'Subjects', 'action' => 'view', $subject->parent_subject->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Elective') ?></th>
            <td><?= h($subject->elective) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Grade Type') ?></th>
            <td><?= h($subject->grade_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subject Type') ?></th>
            <td><?= $subject->has('subject_type') ? $this->Html->link($subject->subject_type->name, ['controller' => 'SubjectTypes', 'action' => 'view', $subject->subject_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($subject->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($subject->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lft') ?></th>
            <td><?= $this->Number->format($subject->lft) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rght') ?></th>
            <td><?= $this->Number->format($subject->rght) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Order Number') ?></th>
            <td><?= $this->Number->format($subject->order_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($subject->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($subject->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($subject->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($subject->edited_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Books') ?></h4>
        <?php if (!empty($subject->books)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Author Name') ?></th>
                <th scope="col"><?= __('Edition') ?></th>
                <th scope="col"><?= __('Volume') ?></th>
                <th scope="col"><?= __('Publisher') ?></th>
                <th scope="col"><?= __('Total Page') ?></th>
                <th scope="col"><?= __('Student Class Id') ?></th>
                <th scope="col"><?= __('Book Condition') ?></th>
                <th scope="col"><?= __('Book Category Id') ?></th>
                <th scope="col"><?= __('Subject Id') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Accession No') ?></th>
                <th scope="col"><?= __('Is Reserved') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($subject->books as $books): ?>
            <tr>
                <td><?= h($books->id) ?></td>
                <td><?= h($books->name) ?></td>
                <td><?= h($books->title) ?></td>
                <td><?= h($books->author_name) ?></td>
                <td><?= h($books->edition) ?></td>
                <td><?= h($books->volume) ?></td>
                <td><?= h($books->publisher) ?></td>
                <td><?= h($books->total_page) ?></td>
                <td><?= h($books->student_class_id) ?></td>
                <td><?= h($books->book_condition) ?></td>
                <td><?= h($books->book_category_id) ?></td>
                <td><?= h($books->subject_id) ?></td>
                <td><?= h($books->price) ?></td>
                <td><?= h($books->accession_no) ?></td>
                <td><?= h($books->is_reserved) ?></td>
                <td><?= h($books->is_deleted) ?></td>
                <td><?= h($books->created_on) ?></td>
                <td><?= h($books->created_by) ?></td>
                <td><?= h($books->edited_on) ?></td>
                <td><?= h($books->edited_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Books', 'action' => 'view', $books->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Books', 'action' => 'edit', $books->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Books', 'action' => 'delete', $books->id], ['confirm' => __('Are you sure you want to delete # {0}?', $books->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Subjects') ?></h4>
        <?php if (!empty($subject->child_subjects)): ?>
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
                <th scope="col"><?= __('Order Number') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($subject->child_subjects as $childSubjects): ?>
            <tr>
                <td><?= h($childSubjects->id) ?></td>
                <td><?= h($childSubjects->session_year_id) ?></td>
                <td><?= h($childSubjects->name) ?></td>
                <td><?= h($childSubjects->student_class_id) ?></td>
                <td><?= h($childSubjects->stream_id) ?></td>
                <td><?= h($childSubjects->parent_id) ?></td>
                <td><?= h($childSubjects->lft) ?></td>
                <td><?= h($childSubjects->rght) ?></td>
                <td><?= h($childSubjects->elective) ?></td>
                <td><?= h($childSubjects->grade_type) ?></td>
                <td><?= h($childSubjects->subject_type_id) ?></td>
                <td><?= h($childSubjects->order_number) ?></td>
                <td><?= h($childSubjects->created_on) ?></td>
                <td><?= h($childSubjects->created_by) ?></td>
                <td><?= h($childSubjects->edited_on) ?></td>
                <td><?= h($childSubjects->edited_by) ?></td>
                <td><?= h($childSubjects->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Subjects', 'action' => 'view', $childSubjects->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Subjects', 'action' => 'edit', $childSubjects->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Subjects', 'action' => 'delete', $childSubjects->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childSubjects->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
