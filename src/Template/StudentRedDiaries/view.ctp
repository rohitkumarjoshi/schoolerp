<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StudentRedDiary $studentRedDiary
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Student Red Diary'), ['action' => 'edit', $studentRedDiary->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Student Red Diary'), ['action' => 'delete', $studentRedDiary->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentRedDiary->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Student Red Diaries'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Red Diary'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="studentRedDiaries view large-9 medium-8 columns content">
    <h3><?= h($studentRedDiary->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Student') ?></th>
            <td><?= $studentRedDiary->has('student') ? $this->Html->link($studentRedDiary->student->name, ['controller' => 'Students', 'action' => 'view', $studentRedDiary->student->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Session Year') ?></th>
            <td><?= $studentRedDiary->has('session_year') ? $this->Html->link($studentRedDiary->session_year->id, ['controller' => 'SessionYears', 'action' => 'view', $studentRedDiary->session_year->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($studentRedDiary->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($studentRedDiary->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Punished By') ?></th>
            <td><?= $this->Number->format($studentRedDiary->punished_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($studentRedDiary->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($studentRedDiary->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Punished From') ?></th>
            <td><?= h($studentRedDiary->punished_from) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Punished To') ?></th>
            <td><?= h($studentRedDiary->punished_to) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($studentRedDiary->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($studentRedDiary->edited_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Reason') ?></h4>
        <?= $this->Text->autoParagraph(h($studentRedDiary->reason)); ?>
    </div>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($studentRedDiary->description)); ?>
    </div>
</div>
