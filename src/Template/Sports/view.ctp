<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sport $sport
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Sport'), ['action' => 'edit', $sport->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Sport'), ['action' => 'delete', $sport->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sport->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sports'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sport'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sport Rows'), ['controller' => 'SportRows', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sport Row'), ['controller' => 'SportRows', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="sports view large-9 medium-8 columns content">
    <h3><?= h($sport->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($sport->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sport Image') ?></th>
            <td><?= h($sport->sport_image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($sport->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($sport->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Sport Rows') ?></h4>
        <?php if (!empty($sport->sport_rows)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Sport Id') ?></th>
                <th scope="col"><?= __('File Path') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($sport->sport_rows as $sportRows): ?>
            <tr>
                <td><?= h($sportRows->id) ?></td>
                <td><?= h($sportRows->sport_id) ?></td>
                <td><?= h($sportRows->file_path) ?></td>
                <td><?= h($sportRows->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'SportRows', 'action' => 'view', $sportRows->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'SportRows', 'action' => 'edit', $sportRows->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'SportRows', 'action' => 'delete', $sportRows->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sportRows->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
