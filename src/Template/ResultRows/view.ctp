<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ResultRow $resultRow
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Result Row'), ['action' => 'edit', $resultRow->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Result Row'), ['action' => 'delete', $resultRow->id], ['confirm' => __('Are you sure you want to delete # {0}?', $resultRow->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Result Rows'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Result Row'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Results'), ['controller' => 'Results', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Result'), ['controller' => 'Results', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exam Masters'), ['controller' => 'ExamMasters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exam Master'), ['controller' => 'ExamMasters', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="resultRows view large-9 medium-8 columns content">
    <h3><?= h($resultRow->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Result') ?></th>
            <td><?= $resultRow->has('result') ? $this->Html->link($resultRow->result->id, ['controller' => 'Results', 'action' => 'view', $resultRow->result->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subject') ?></th>
            <td><?= $resultRow->has('subject') ? $this->Html->link($resultRow->subject->name, ['controller' => 'Subjects', 'action' => 'view', $resultRow->subject->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Exam Master') ?></th>
            <td><?= $resultRow->has('exam_master') ? $this->Html->link($resultRow->exam_master->name, ['controller' => 'ExamMasters', 'action' => 'view', $resultRow->exam_master->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Grade') ?></th>
            <td><?= h($resultRow->grade) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($resultRow->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total') ?></th>
            <td><?= $this->Number->format($resultRow->total) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Obtain') ?></th>
            <td><?= $this->Number->format($resultRow->obtain) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Grace') ?></th>
            <td><?= $this->Number->format($resultRow->grace) ?></td>
        </tr>
    </table>
</div>
