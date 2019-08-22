<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StudentSibling $studentSibling
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Student Sibling'), ['action' => 'edit', $studentSibling->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Student Sibling'), ['action' => 'delete', $studentSibling->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentSibling->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Student Siblings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Sibling'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="studentSiblings view large-9 medium-8 columns content">
    <h3><?= h($studentSibling->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Student') ?></th>
            <td><?= $studentSibling->has('student') ? $this->Html->link($studentSibling->student->name, ['controller' => 'Students', 'action' => 'view', $studentSibling->student->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Session Year') ?></th>
            <td><?= $studentSibling->has('session_year') ? $this->Html->link($studentSibling->session_year->id, ['controller' => 'SessionYears', 'action' => 'view', $studentSibling->session_year->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($studentSibling->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($studentSibling->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sibling Id') ?></th>
            <td><?= $this->Number->format($studentSibling->sibling_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($studentSibling->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($studentSibling->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($studentSibling->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($studentSibling->edited_on) ?></td>
        </tr>
    </table>
</div>
