<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Result[]|\Cake\Collection\CollectionInterface $results
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Result'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Student Infos'), ['controller' => 'StudentInfos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student Info'), ['controller' => 'StudentInfos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Exam Masters'), ['controller' => 'ExamMasters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Exam Master'), ['controller' => 'ExamMasters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Result Rows'), ['controller' => 'ResultRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Result Row'), ['controller' => 'ResultRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="results index large-9 medium-8 columns content">
    <h3><?= __('Results') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('student_info_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('exam_master_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total') ?></th>
                <th scope="col"><?= $this->Paginator->sort('obtain') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('division') ?></th>
                <th scope="col"><?= $this->Paginator->sort('percentage') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $result): ?>
            <tr>
                <td><?= $this->Number->format($result->id) ?></td>
                <td><?= $result->has('student_info') ? $this->Html->link($result->student_info->id, ['controller' => 'StudentInfos', 'action' => 'view', $result->student_info->id]) : '' ?></td>
                <td><?= $result->has('exam_master') ? $this->Html->link($result->exam_master->name, ['controller' => 'ExamMasters', 'action' => 'view', $result->exam_master->id]) : '' ?></td>
                <td><?= $this->Number->format($result->total) ?></td>
                <td><?= $this->Number->format($result->obtain) ?></td>
                <td><?= h($result->status) ?></td>
                <td><?= h($result->division) ?></td>
                <td><?= $this->Number->format($result->percentage) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $result->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $result->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $result->id], ['confirm' => __('Are you sure you want to delete # {0}?', $result->id)]) ?>
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
