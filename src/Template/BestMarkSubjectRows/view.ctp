<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BestMarkSubjectRow $bestMarkSubjectRow
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Best Mark Subject Row'), ['action' => 'edit', $bestMarkSubjectRow->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Best Mark Subject Row'), ['action' => 'delete', $bestMarkSubjectRow->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bestMarkSubjectRow->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Best Mark Subject Rows'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Best Mark Subject Row'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Best Mark Subjects'), ['controller' => 'BestMarkSubjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Best Mark Subject'), ['controller' => 'BestMarkSubjects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exam Masters'), ['controller' => 'ExamMasters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exam Master'), ['controller' => 'ExamMasters', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="bestMarkSubjectRows view large-9 medium-8 columns content">
    <h3><?= h($bestMarkSubjectRow->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Best Mark Subject') ?></th>
            <td><?= $bestMarkSubjectRow->has('best_mark_subject') ? $this->Html->link($bestMarkSubjectRow->best_mark_subject->id, ['controller' => 'BestMarkSubjects', 'action' => 'view', $bestMarkSubjectRow->best_mark_subject->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Exam Master') ?></th>
            <td><?= $bestMarkSubjectRow->has('exam_master') ? $this->Html->link($bestMarkSubjectRow->exam_master->name, ['controller' => 'ExamMasters', 'action' => 'view', $bestMarkSubjectRow->exam_master->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($bestMarkSubjectRow->id) ?></td>
        </tr>
    </table>
</div>
