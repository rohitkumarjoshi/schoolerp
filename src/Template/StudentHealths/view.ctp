<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StudentHealth $studentHealth
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Student Health'), ['action' => 'edit', $studentHealth->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Student Health'), ['action' => 'delete', $studentHealth->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentHealth->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Student Healths'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Health'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Student Infos'), ['controller' => 'StudentInfos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Info'), ['controller' => 'StudentInfos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Health Masters'), ['controller' => 'HealthMasters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Health Master'), ['controller' => 'HealthMasters', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="studentHealths view large-9 medium-8 columns content">
    <h3><?= h($studentHealth->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Session Year') ?></th>
            <td><?= $studentHealth->has('session_year') ? $this->Html->link($studentHealth->session_year->id, ['controller' => 'SessionYears', 'action' => 'view', $studentHealth->session_year->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Student Info') ?></th>
            <td><?= $studentHealth->has('student_info') ? $this->Html->link($studentHealth->student_info->id, ['controller' => 'StudentInfos', 'action' => 'view', $studentHealth->student_info->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Health Master') ?></th>
            <td><?= $studentHealth->has('health_master') ? $this->Html->link($studentHealth->health_master->id, ['controller' => 'HealthMasters', 'action' => 'view', $studentHealth->health_master->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Health Value') ?></th>
            <td><?= h($studentHealth->health_value) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($studentHealth->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($studentHealth->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($studentHealth->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($studentHealth->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($studentHealth->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($studentHealth->edited_on) ?></td>
        </tr>
    </table>
</div>
