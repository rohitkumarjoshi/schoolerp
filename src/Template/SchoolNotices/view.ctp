<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SchoolNotice $schoolNotice
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit School Notice'), ['action' => 'edit', $schoolNotice->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete School Notice'), ['action' => 'delete', $schoolNotice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $schoolNotice->id)]) ?> </li>
        <li><?= $this->Html->link(__('List School Notices'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New School Notice'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="schoolNotices view large-9 medium-8 columns content">
    <h3><?= h($schoolNotice->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($schoolNotice->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Doc File') ?></th>
            <td><?= h($schoolNotice->doc_file) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($schoolNotice->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($schoolNotice->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= $this->Number->format($schoolNotice->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($schoolNotice->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($schoolNotice->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date From') ?></th>
            <td><?= h($schoolNotice->date_from) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date To') ?></th>
            <td><?= h($schoolNotice->date_to) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($schoolNotice->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($schoolNotice->edited_on) ?></td>
        </tr>
    </table>
</div>
