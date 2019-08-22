<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NoticeCategory $noticeCategory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Notice Category'), ['action' => 'edit', $noticeCategory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Notice Category'), ['action' => 'delete', $noticeCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $noticeCategory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Notice Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Notice Category'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Notices'), ['controller' => 'Notices', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Notice'), ['controller' => 'Notices', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="noticeCategories view large-9 medium-8 columns content">
    <h3><?= h($noticeCategory->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($noticeCategory->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($noticeCategory->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($noticeCategory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($noticeCategory->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($noticeCategory->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($noticeCategory->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($noticeCategory->edited_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Notices') ?></h4>
        <?php if (!empty($noticeCategory->notices)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Session Year Id') ?></th>
                <th scope="col"><?= __('Notice Category Id') ?></th>
                <th scope="col"><?= __('Notice Type') ?></th>
                <th scope="col"><?= __('Doc') ?></th>
                <th scope="col"><?= __('Valid From') ?></th>
                <th scope="col"><?= __('Valid To') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($noticeCategory->notices as $notices): ?>
            <tr>
                <td><?= h($notices->id) ?></td>
                <td><?= h($notices->session_year_id) ?></td>
                <td><?= h($notices->notice_category_id) ?></td>
                <td><?= h($notices->notice_type) ?></td>
                <td><?= h($notices->doc) ?></td>
                <td><?= h($notices->valid_from) ?></td>
                <td><?= h($notices->valid_to) ?></td>
                <td><?= h($notices->is_deleted) ?></td>
                <td><?= h($notices->created_on) ?></td>
                <td><?= h($notices->created_by) ?></td>
                <td><?= h($notices->edited_on) ?></td>
                <td><?= h($notices->edited_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Notices', 'action' => 'view', $notices->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Notices', 'action' => 'edit', $notices->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Notices', 'action' => 'delete', $notices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notices->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
