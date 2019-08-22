<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Result $result
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Result'), ['action' => 'edit', $result->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Result'), ['action' => 'delete', $result->id], ['confirm' => __('Are you sure you want to delete # {0}?', $result->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Results'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Result'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Student Infos'), ['controller' => 'StudentInfos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Info'), ['controller' => 'StudentInfos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exam Masters'), ['controller' => 'ExamMasters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exam Master'), ['controller' => 'ExamMasters', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Result Rows'), ['controller' => 'ResultRows', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Result Row'), ['controller' => 'ResultRows', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="results view large-9 medium-8 columns content">
    <h3><?= h($result->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Student Info') ?></th>
            <td><?= $result->has('student_info') ? $this->Html->link($result->student_info->id, ['controller' => 'StudentInfos', 'action' => 'view', $result->student_info->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Exam Master') ?></th>
            <td><?= $result->has('exam_master') ? $this->Html->link($result->exam_master->name, ['controller' => 'ExamMasters', 'action' => 'view', $result->exam_master->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($result->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Division') ?></th>
            <td><?= h($result->division) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($result->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total') ?></th>
            <td><?= $this->Number->format($result->total) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Obtain') ?></th>
            <td><?= $this->Number->format($result->obtain) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Percentage') ?></th>
            <td><?= $this->Number->format($result->percentage) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Grade') ?></h4>
        <?= $this->Text->autoParagraph(h($result->grade)); ?>
    </div>
    <div class="row">
        <h4><?= __('Supplementary') ?></h4>
        <?= $this->Text->autoParagraph(h($result->supplementary)); ?>
    </div>
    <div class="row">
        <h4><?= __('Fail') ?></h4>
        <?= $this->Text->autoParagraph(h($result->fail)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Result Rows') ?></h4>
        <?php if (!empty($result->result_rows)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Result Id') ?></th>
                <th scope="col"><?= __('Subject Id') ?></th>
                <th scope="col"><?= __('Exam Master Id') ?></th>
                <th scope="col"><?= __('Total') ?></th>
                <th scope="col"><?= __('Obtain') ?></th>
                <th scope="col"><?= __('Grade') ?></th>
                <th scope="col"><?= __('Grace') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($result->result_rows as $resultRows): ?>
            <tr>
                <td><?= h($resultRows->id) ?></td>
                <td><?= h($resultRows->result_id) ?></td>
                <td><?= h($resultRows->subject_id) ?></td>
                <td><?= h($resultRows->exam_master_id) ?></td>
                <td><?= h($resultRows->total) ?></td>
                <td><?= h($resultRows->obtain) ?></td>
                <td><?= h($resultRows->grade) ?></td>
                <td><?= h($resultRows->grace) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ResultRows', 'action' => 'view', $resultRows->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ResultRows', 'action' => 'edit', $resultRows->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ResultRows', 'action' => 'delete', $resultRows->id], ['confirm' => __('Are you sure you want to delete # {0}?', $resultRows->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
