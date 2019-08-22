<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AchivementCategory $achivementCategory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Achivement Category'), ['action' => 'edit', $achivementCategory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Achivement Category'), ['action' => 'delete', $achivementCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $achivementCategory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Achivement Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Achivement Category'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Student Achivements'), ['controller' => 'StudentAchivements', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Achivement'), ['controller' => 'StudentAchivements', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="achivementCategories view large-9 medium-8 columns content">
    <h3><?= h($achivementCategory->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($achivementCategory->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($achivementCategory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($achivementCategory->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($achivementCategory->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($achivementCategory->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($achivementCategory->edited_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Student Achivements') ?></h4>
        <?php if (!empty($achivementCategory->student_achivements)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Session Year Id') ?></th>
                <th scope="col"><?= __('Achivement Category Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($achivementCategory->student_achivements as $studentAchivements): ?>
            <tr>
                <td><?= h($studentAchivements->id) ?></td>
                <td><?= h($studentAchivements->session_year_id) ?></td>
                <td><?= h($studentAchivements->achivement_category_id) ?></td>
                <td><?= h($studentAchivements->student_id) ?></td>
                <td><?= h($studentAchivements->description) ?></td>
                <td><?= h($studentAchivements->created_on) ?></td>
                <td><?= h($studentAchivements->created_by) ?></td>
                <td><?= h($studentAchivements->edited_on) ?></td>
                <td><?= h($studentAchivements->edited_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'StudentAchivements', 'action' => 'view', $studentAchivements->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'StudentAchivements', 'action' => 'edit', $studentAchivements->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'StudentAchivements', 'action' => 'delete', $studentAchivements->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentAchivements->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
