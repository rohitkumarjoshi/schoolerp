<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BestMarkSubject $bestMarkSubject
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Best Mark Subject'), ['action' => 'edit', $bestMarkSubject->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Best Mark Subject'), ['action' => 'delete', $bestMarkSubject->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bestMarkSubject->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Best Mark Subjects'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Best Mark Subject'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Student Classes'), ['controller' => 'StudentClasses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Class'), ['controller' => 'StudentClasses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Streams'), ['controller' => 'Streams', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stream'), ['controller' => 'Streams', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Best Mark Subject Rows'), ['controller' => 'BestMarkSubjectRows', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Best Mark Subject Row'), ['controller' => 'BestMarkSubjectRows', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="bestMarkSubjects view large-9 medium-8 columns content">
    <h3><?= h($bestMarkSubject->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Session Year') ?></th>
            <td><?= $bestMarkSubject->has('session_year') ? $this->Html->link($bestMarkSubject->session_year->id, ['controller' => 'SessionYears', 'action' => 'view', $bestMarkSubject->session_year->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Student Class') ?></th>
            <td><?= $bestMarkSubject->has('student_class') ? $this->Html->link($bestMarkSubject->student_class->name, ['controller' => 'StudentClasses', 'action' => 'view', $bestMarkSubject->student_class->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stream') ?></th>
            <td><?= $bestMarkSubject->has('stream') ? $this->Html->link($bestMarkSubject->stream->name, ['controller' => 'Streams', 'action' => 'view', $bestMarkSubject->stream->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subject') ?></th>
            <td><?= $bestMarkSubject->has('subject') ? $this->Html->link($bestMarkSubject->subject->name, ['controller' => 'Subjects', 'action' => 'view', $bestMarkSubject->subject->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($bestMarkSubject->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($bestMarkSubject->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('No Of Best Subject') ?></th>
            <td><?= $this->Number->format($bestMarkSubject->no_of_best_subject) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($bestMarkSubject->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($bestMarkSubject->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($bestMarkSubject->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($bestMarkSubject->edited_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Best Mark Subject Rows') ?></h4>
        <?php if (!empty($bestMarkSubject->best_mark_subject_rows)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Best Mark Subject Id') ?></th>
                <th scope="col"><?= __('Exam Master Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($bestMarkSubject->best_mark_subject_rows as $bestMarkSubjectRows): ?>
            <tr>
                <td><?= h($bestMarkSubjectRows->id) ?></td>
                <td><?= h($bestMarkSubjectRows->best_mark_subject_id) ?></td>
                <td><?= h($bestMarkSubjectRows->exam_master_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'BestMarkSubjectRows', 'action' => 'view', $bestMarkSubjectRows->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'BestMarkSubjectRows', 'action' => 'edit', $bestMarkSubjectRows->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'BestMarkSubjectRows', 'action' => 'delete', $bestMarkSubjectRows->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bestMarkSubjectRows->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
