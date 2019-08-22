<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FacultyClassMapping $facultyClassMapping
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Faculty Class Mapping'), ['action' => 'edit', $facultyClassMapping->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Faculty Class Mapping'), ['action' => 'delete', $facultyClassMapping->id], ['confirm' => __('Are you sure you want to delete # {0}?', $facultyClassMapping->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Faculty Class Mappings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Faculty Class Mapping'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Class Mappings'), ['controller' => 'ClassMappings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Class Mapping'), ['controller' => 'ClassMappings', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="facultyClassMappings view large-9 medium-8 columns content">
    <h3><?= h($facultyClassMapping->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Class Mapping') ?></th>
            <td><?= $facultyClassMapping->has('class_mapping') ? $this->Html->link($facultyClassMapping->class_mapping->id, ['controller' => 'ClassMappings', 'action' => 'view', $facultyClassMapping->class_mapping->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Employee') ?></th>
            <td><?= $facultyClassMapping->has('employee') ? $this->Html->link($facultyClassMapping->employee->name, ['controller' => 'Employees', 'action' => 'view', $facultyClassMapping->employee->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Session Year') ?></th>
            <td><?= $facultyClassMapping->has('session_year') ? $this->Html->link($facultyClassMapping->session_year->id, ['controller' => 'SessionYears', 'action' => 'view', $facultyClassMapping->session_year->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($facultyClassMapping->id) ?></td>
        </tr>
    </table>
</div>
