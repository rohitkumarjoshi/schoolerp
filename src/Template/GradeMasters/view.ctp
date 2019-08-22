<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GradeMaster $gradeMaster
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Grade Master'), ['action' => 'edit', $gradeMaster->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Grade Master'), ['action' => 'delete', $gradeMaster->id], ['confirm' => __('Are you sure you want to delete # {0}?', $gradeMaster->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Grade Masters'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Grade Master'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Student Classes'), ['controller' => 'StudentClasses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Class'), ['controller' => 'StudentClasses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Streams'), ['controller' => 'Streams', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stream'), ['controller' => 'Streams', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="gradeMasters view large-9 medium-8 columns content">
    <h3><?= h($gradeMaster->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Session Year') ?></th>
            <td><?= $gradeMaster->has('session_year') ? $this->Html->link($gradeMaster->session_year->id, ['controller' => 'SessionYears', 'action' => 'view', $gradeMaster->session_year->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Student Class') ?></th>
            <td><?= $gradeMaster->has('student_class') ? $this->Html->link($gradeMaster->student_class->name, ['controller' => 'StudentClasses', 'action' => 'view', $gradeMaster->student_class->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stream') ?></th>
            <td><?= $gradeMaster->has('stream') ? $this->Html->link($gradeMaster->stream->name, ['controller' => 'Streams', 'action' => 'view', $gradeMaster->stream->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Grade') ?></th>
            <td><?= h($gradeMaster->grade) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($gradeMaster->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($gradeMaster->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Min Marks') ?></th>
            <td><?= $this->Number->format($gradeMaster->min_marks) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Max Marks') ?></th>
            <td><?= $this->Number->format($gradeMaster->max_marks) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($gradeMaster->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($gradeMaster->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($gradeMaster->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($gradeMaster->edited_on) ?></td>
        </tr>
    </table>
</div>
