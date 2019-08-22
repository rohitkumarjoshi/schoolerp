<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MealType $mealType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Meal Type'), ['action' => 'edit', $mealType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Meal Type'), ['action' => 'delete', $mealType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mealType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Meal Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Meal Type'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Mess Attendances'), ['controller' => 'MessAttendances', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mess Attendance'), ['controller' => 'MessAttendances', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="mealTypes view large-9 medium-8 columns content">
    <h3><?= h($mealType->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($mealType->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($mealType->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($mealType->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($mealType->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($mealType->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($mealType->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($mealType->edited_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Mess Attendances') ?></h4>
        <?php if (!empty($mealType->mess_attendances)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Session Year Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Meal Type Id') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Time') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($mealType->mess_attendances as $messAttendances): ?>
            <tr>
                <td><?= h($messAttendances->id) ?></td>
                <td><?= h($messAttendances->session_year_id) ?></td>
                <td><?= h($messAttendances->student_id) ?></td>
                <td><?= h($messAttendances->meal_type_id) ?></td>
                <td><?= h($messAttendances->date) ?></td>
                <td><?= h($messAttendances->time) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'MessAttendances', 'action' => 'view', $messAttendances->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'MessAttendances', 'action' => 'edit', $messAttendances->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'MessAttendances', 'action' => 'delete', $messAttendances->id], ['confirm' => __('Are you sure you want to delete # {0}?', $messAttendances->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
