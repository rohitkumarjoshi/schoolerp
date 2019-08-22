<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ResultRow[]|\Cake\Collection\CollectionInterface $resultRows
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Result Row'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Results'), ['controller' => 'Results', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Result'), ['controller' => 'Results', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Exam Masters'), ['controller' => 'ExamMasters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Exam Master'), ['controller' => 'ExamMasters', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="resultRows index large-9 medium-8 columns content">
    <h3><?= __('Result Rows') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('result_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('subject_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('exam_master_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total') ?></th>
                <th scope="col"><?= $this->Paginator->sort('obtain') ?></th>
                <th scope="col"><?= $this->Paginator->sort('grade') ?></th>
                <th scope="col"><?= $this->Paginator->sort('grace') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultRows as $resultRow): ?>
            <tr>
                <td><?= $this->Number->format($resultRow->id) ?></td>
                <td><?= $resultRow->has('result') ? $this->Html->link($resultRow->result->id, ['controller' => 'Results', 'action' => 'view', $resultRow->result->id]) : '' ?></td>
                <td><?= $resultRow->has('subject') ? $this->Html->link($resultRow->subject->name, ['controller' => 'Subjects', 'action' => 'view', $resultRow->subject->id]) : '' ?></td>
                <td><?= $resultRow->has('exam_master') ? $this->Html->link($resultRow->exam_master->name, ['controller' => 'ExamMasters', 'action' => 'view', $resultRow->exam_master->id]) : '' ?></td>
                <td><?= $this->Number->format($resultRow->total) ?></td>
                <td><?= $this->Number->format($resultRow->obtain) ?></td>
                <td><?= h($resultRow->grade) ?></td>
                <td><?= $this->Number->format($resultRow->grace) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $resultRow->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $resultRow->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $resultRow->id], ['confirm' => __('Are you sure you want to delete # {0}?', $resultRow->id)]) ?>
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
