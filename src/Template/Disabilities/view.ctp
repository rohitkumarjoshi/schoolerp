<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Disability $disability
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Disability'), ['action' => 'edit', $disability->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Disability'), ['action' => 'delete', $disability->id], ['confirm' => __('Are you sure you want to delete # {0}?', $disability->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Disabilities'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Disability'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="disabilities view large-9 medium-8 columns content">
    <h3><?= h($disability->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($disability->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($disability->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($disability->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($disability->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($disability->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($disability->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($disability->edited_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Students') ?></h4>
        <?php if (!empty($disability->students)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Father Name') ?></th>
                <th scope="col"><?= __('Mother Name') ?></th>
                <th scope="col"><?= __('Scholar No') ?></th>
                <th scope="col"><?= __('Registration Date') ?></th>
                <th scope="col"><?= __('Dob') ?></th>
                <th scope="col"><?= __('Gender Id') ?></th>
                <th scope="col"><?= __('Nationality') ?></th>
                <th scope="col"><?= __('Parent Mobile No') ?></th>
                <th scope="col"><?= __('Student Mobile No') ?></th>
                <th scope="col"><?= __('Session Year Id') ?></th>
                <th scope="col"><?= __('Admission Class Id') ?></th>
                <th scope="col"><?= __('Admission Date') ?></th>
                <th scope="col"><?= __('Admission Medium Id') ?></th>
                <th scope="col"><?= __('Admission Stream Id') ?></th>
                <th scope="col"><?= __('Last School Name') ?></th>
                <th scope="col"><?= __('Disability Id') ?></th>
                <th scope="col"><?= __('Student Status') ?></th>
                <th scope="col"><?= __('Last Class Id') ?></th>
                <th scope="col"><?= __('Last Stream Id') ?></th>
                <th scope="col"><?= __('Last Medium Id') ?></th>
                <th scope="col"><?= __('Barcode No') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($disability->students as $students): ?>
            <tr>
                <td><?= h($students->id) ?></td>
                <td><?= h($students->name) ?></td>
                <td><?= h($students->father_name) ?></td>
                <td><?= h($students->mother_name) ?></td>
                <td><?= h($students->scholar_no) ?></td>
                <td><?= h($students->registration_date) ?></td>
                <td><?= h($students->dob) ?></td>
                <td><?= h($students->gender_id) ?></td>
                <td><?= h($students->nationality) ?></td>
                <td><?= h($students->parent_mobile_no) ?></td>
                <td><?= h($students->student_mobile_no) ?></td>
                <td><?= h($students->session_year_id) ?></td>
                <td><?= h($students->admission_class_id) ?></td>
                <td><?= h($students->admission_date) ?></td>
                <td><?= h($students->admission_medium_id) ?></td>
                <td><?= h($students->admission_stream_id) ?></td>
                <td><?= h($students->last_school_name) ?></td>
                <td><?= h($students->disability_id) ?></td>
                <td><?= h($students->student_status) ?></td>
                <td><?= h($students->last_class_id) ?></td>
                <td><?= h($students->last_stream_id) ?></td>
                <td><?= h($students->last_medium_id) ?></td>
                <td><?= h($students->barcode_no) ?></td>
                <td><?= h($students->created_on) ?></td>
                <td><?= h($students->created_by) ?></td>
                <td><?= h($students->edited_on) ?></td>
                <td><?= h($students->edited_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Students', 'action' => 'view', $students->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Students', 'action' => 'edit', $students->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Students', 'action' => 'delete', $students->id], ['confirm' => __('Are you sure you want to delete # {0}?', $students->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
