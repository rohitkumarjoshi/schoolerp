<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Attendance[]|\Cake\Collection\CollectionInterface $attendances
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Attendance'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Student Classes'), ['controller' => 'StudentClasses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student Class'), ['controller' => 'StudentClasses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Streams'), ['controller' => 'Streams', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Stream'), ['controller' => 'Streams', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sections'), ['controller' => 'Sections', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Section'), ['controller' => 'Sections', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Student Infos'), ['controller' => 'StudentInfos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student Info'), ['controller' => 'StudentInfos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="attendances index large-9 medium-8 columns content">
    <h3><?= __('Attendances') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('session_year_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('medium_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('student_class_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('stream_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('section_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('student_info_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('first_half') ?></th>
                <th scope="col"><?= $this->Paginator->sort('second_half') ?></th>
                <th scope="col"><?= $this->Paginator->sort('attendance_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('edited_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('edited_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($attendances as $attendance): ?>
            <tr>
                <td><?= $this->Number->format($attendance->id) ?></td>
                <td><?= $attendance->has('session_year') ? $this->Html->link($attendance->session_year->id, ['controller' => 'SessionYears', 'action' => 'view', $attendance->session_year->id]) : '' ?></td>
                <td><?= $this->Number->format($attendance->medium_id) ?></td>
                <td><?= $attendance->has('student_class') ? $this->Html->link($attendance->student_class->name, ['controller' => 'StudentClasses', 'action' => 'view', $attendance->student_class->id]) : '' ?></td>
                <td><?= $attendance->has('stream') ? $this->Html->link($attendance->stream->name, ['controller' => 'Streams', 'action' => 'view', $attendance->stream->id]) : '' ?></td>
                <td><?= $attendance->has('section') ? $this->Html->link($attendance->section->name, ['controller' => 'Sections', 'action' => 'view', $attendance->section->id]) : '' ?></td>
                <td><?= $attendance->has('student_info') ? $this->Html->link($attendance->student_info->id, ['controller' => 'StudentInfos', 'action' => 'view', $attendance->student_info->id]) : '' ?></td>
                <td><?= h($attendance->first_half) ?></td>
                <td><?= h($attendance->second_half) ?></td>
                <td><?= h($attendance->attendance_date) ?></td>
                <td><?= h($attendance->created_on) ?></td>
                <td><?= $this->Number->format($attendance->created_by) ?></td>
                <td><?= h($attendance->edited_on) ?></td>
                <td><?= $this->Number->format($attendance->edited_by) ?></td>
                <td><?= h($attendance->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $attendance->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $attendance->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $attendance->id], ['confirm' => __('Are you sure you want to delete # {0}?', $attendance->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
