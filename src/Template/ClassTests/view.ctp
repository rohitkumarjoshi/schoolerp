<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClassTest $classTest
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Class Test'), ['action' => 'edit', $classTest->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Class Test'), ['action' => 'delete', $classTest->id], ['confirm' => __('Are you sure you want to delete # {0}?', $classTest->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Class Tests'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Class Test'), ['action' => 'add']) ?> </li>
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
        <li><?= $this->Html->link(__('List Class Test Students'), ['controller' => 'ClassTestStudents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Class Test Student'), ['controller' => 'ClassTestStudents', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="classTests view large-9 medium-8 columns content">
    <h3><?= h($classTest->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Session Year') ?></th>
            <td><?= $classTest->has('session_year') ? $this->Html->link($classTest->session_year->id, ['controller' => 'SessionYears', 'action' => 'view', $classTest->session_year->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Student Class') ?></th>
            <td><?= $classTest->has('student_class') ? $this->Html->link($classTest->student_class->name, ['controller' => 'StudentClasses', 'action' => 'view', $classTest->student_class->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stream') ?></th>
            <td><?= $classTest->has('stream') ? $this->Html->link($classTest->stream->name, ['controller' => 'Streams', 'action' => 'view', $classTest->stream->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Section') ?></th>
            <td><?= $classTest->has('section') ? $this->Html->link($classTest->section->name, ['controller' => 'Sections', 'action' => 'view', $classTest->section->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subject') ?></th>
            <td><?= $classTest->has('subject') ? $this->Html->link($classTest->subject->name, ['controller' => 'Subjects', 'action' => 'view', $classTest->subject->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($classTest->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($classTest->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Medium Id') ?></th>
            <td><?= $this->Number->format($classTest->medium_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Max Marks') ?></th>
            <td><?= $this->Number->format($classTest->max_marks) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($classTest->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($classTest->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Test Date') ?></th>
            <td><?= h($classTest->test_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($classTest->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($classTest->edited_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Topic') ?></h4>
        <?= $this->Text->autoParagraph(h($classTest->topic)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Class Test Students') ?></h4>
        <?php if (!empty($classTest->class_test_students)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Class Test Id') ?></th>
                <th scope="col"><?= __('Student Info Id') ?></th>
                <th scope="col"><?= __('Marks') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($classTest->class_test_students as $classTestStudents): ?>
            <tr>
                <td><?= h($classTestStudents->id) ?></td>
                <td><?= h($classTestStudents->class_test_id) ?></td>
                <td><?= h($classTestStudents->student_info_id) ?></td>
                <td><?= h($classTestStudents->marks) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ClassTestStudents', 'action' => 'view', $classTestStudents->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ClassTestStudents', 'action' => 'edit', $classTestStudents->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ClassTestStudents', 'action' => 'delete', $classTestStudents->id], ['confirm' => __('Are you sure you want to delete # {0}?', $classTestStudents->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
