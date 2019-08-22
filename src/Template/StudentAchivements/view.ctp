<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StudentAchivement $studentAchivement
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Student Achivement'), ['action' => 'edit', $studentAchivement->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Student Achivement'), ['action' => 'delete', $studentAchivement->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentAchivement->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Student Achivements'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Achivement'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Achivement Categories'), ['controller' => 'AchivementCategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Achivement Category'), ['controller' => 'AchivementCategories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="studentAchivements view large-9 medium-8 columns content">
    <h3><?= h($studentAchivement->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Session Year') ?></th>
            <td><?= $studentAchivement->has('session_year') ? $this->Html->link($studentAchivement->session_year->id, ['controller' => 'SessionYears', 'action' => 'view', $studentAchivement->session_year->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Achivement Category') ?></th>
            <td><?= $studentAchivement->has('achivement_category') ? $this->Html->link($studentAchivement->achivement_category->name, ['controller' => 'AchivementCategories', 'action' => 'view', $studentAchivement->achivement_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Achivement Type') ?></th>
            <td><?= h($studentAchivement->achivement_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Student') ?></th>
            <td><?= $studentAchivement->has('student') ? $this->Html->link($studentAchivement->student->name, ['controller' => 'Students', 'action' => 'view', $studentAchivement->student->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($studentAchivement->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($studentAchivement->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($studentAchivement->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($studentAchivement->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($studentAchivement->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($studentAchivement->edited_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($studentAchivement->description)); ?>
    </div>
</div>
