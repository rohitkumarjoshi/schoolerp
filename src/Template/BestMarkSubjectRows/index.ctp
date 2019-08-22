<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BestMarkSubjectRow[]|\Cake\Collection\CollectionInterface $bestMarkSubjectRows
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Best Mark Subject Row'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Best Mark Subjects'), ['controller' => 'BestMarkSubjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Best Mark Subject'), ['controller' => 'BestMarkSubjects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Exam Masters'), ['controller' => 'ExamMasters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Exam Master'), ['controller' => 'ExamMasters', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bestMarkSubjectRows index large-9 medium-8 columns content">
    <h3><?= __('Best Mark Subject Rows') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('best_mark_subject_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('exam_master_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bestMarkSubjectRows as $bestMarkSubjectRow): ?>
            <tr>
                <td><?= $this->Number->format($bestMarkSubjectRow->id) ?></td>
                <td><?= $bestMarkSubjectRow->has('best_mark_subject') ? $this->Html->link($bestMarkSubjectRow->best_mark_subject->id, ['controller' => 'BestMarkSubjects', 'action' => 'view', $bestMarkSubjectRow->best_mark_subject->id]) : '' ?></td>
                <td><?= $bestMarkSubjectRow->has('exam_master') ? $this->Html->link($bestMarkSubjectRow->exam_master->name, ['controller' => 'ExamMasters', 'action' => 'view', $bestMarkSubjectRow->exam_master->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $bestMarkSubjectRow->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bestMarkSubjectRow->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bestMarkSubjectRow->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bestMarkSubjectRow->id)]) ?>
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
