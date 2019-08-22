<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LibraryStudentInOut $libraryStudentInOut
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Library Student In Out'), ['action' => 'edit', $libraryStudentInOut->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Library Student In Out'), ['action' => 'delete', $libraryStudentInOut->id], ['confirm' => __('Are you sure you want to delete # {0}?', $libraryStudentInOut->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Library Student In Outs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Library Student In Out'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="libraryStudentInOuts view large-9 medium-8 columns content">
    <h3><?= h($libraryStudentInOut->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Student') ?></th>
            <td><?= $libraryStudentInOut->has('student') ? $this->Html->link($libraryStudentInOut->student->name, ['controller' => 'Students', 'action' => 'view', $libraryStudentInOut->student->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Session Year') ?></th>
            <td><?= $libraryStudentInOut->has('session_year') ? $this->Html->link($libraryStudentInOut->session_year->id, ['controller' => 'SessionYears', 'action' => 'view', $libraryStudentInOut->session_year->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($libraryStudentInOut->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($libraryStudentInOut->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('In Date') ?></th>
            <td><?= h($libraryStudentInOut->in_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('In Time') ?></th>
            <td><?= h($libraryStudentInOut->in_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Out Date') ?></th>
            <td><?= h($libraryStudentInOut->out_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Out Time') ?></th>
            <td><?= h($libraryStudentInOut->out_time) ?></td>
        </tr>
    </table>
</div>
