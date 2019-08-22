<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HealthMaster $healthMaster
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Health Master'), ['action' => 'edit', $healthMaster->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Health Master'), ['action' => 'delete', $healthMaster->id], ['confirm' => __('Are you sure you want to delete # {0}?', $healthMaster->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Health Masters'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Health Master'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Student Healths'), ['controller' => 'StudentHealths', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Health'), ['controller' => 'StudentHealths', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="healthMasters view large-9 medium-8 columns content">
    <h3><?= h($healthMaster->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Health Type') ?></th>
            <td><?= h($healthMaster->health_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Unit') ?></th>
            <td><?= h($healthMaster->unit) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($healthMaster->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($healthMaster->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($healthMaster->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($healthMaster->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($healthMaster->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($healthMaster->edited_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Student Healths') ?></h4>
        <?php if (!empty($healthMaster->student_healths)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Session Year Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Student Info Id') ?></th>
                <th scope="col"><?= __('Health Master Id') ?></th>
                <th scope="col"><?= __('Health Value') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($healthMaster->student_healths as $studentHealths): ?>
            <tr>
                <td><?= h($studentHealths->id) ?></td>
                <td><?= h($studentHealths->session_year_id) ?></td>
                <td><?= h($studentHealths->student_id) ?></td>
                <td><?= h($studentHealths->student_info_id) ?></td>
                <td><?= h($studentHealths->health_master_id) ?></td>
                <td><?= h($studentHealths->health_value) ?></td>
                <td><?= h($studentHealths->created_on) ?></td>
                <td><?= h($studentHealths->created_by) ?></td>
                <td><?= h($studentHealths->edited_on) ?></td>
                <td><?= h($studentHealths->edited_by) ?></td>
                <td><?= h($studentHealths->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'StudentHealths', 'action' => 'view', $studentHealths->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'StudentHealths', 'action' => 'edit', $studentHealths->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'StudentHealths', 'action' => 'delete', $studentHealths->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentHealths->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
