<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HostelStudentAsset $hostelStudentAsset
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Hostel Student Asset'), ['action' => 'edit', $hostelStudentAsset->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Hostel Student Asset'), ['action' => 'delete', $hostelStudentAsset->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hostelStudentAsset->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Hostel Student Assets'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hostel Student Asset'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Hostel Room Assets'), ['controller' => 'HostelRoomAssets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hostel Room Asset'), ['controller' => 'HostelRoomAssets', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="hostelStudentAssets view large-9 medium-8 columns content">
    <h3><?= h($hostelStudentAsset->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Student') ?></th>
            <td><?= $hostelStudentAsset->has('student') ? $this->Html->link($hostelStudentAsset->student->name, ['controller' => 'Students', 'action' => 'view', $hostelStudentAsset->student->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Session Year') ?></th>
            <td><?= $hostelStudentAsset->has('session_year') ? $this->Html->link($hostelStudentAsset->session_year->id, ['controller' => 'SessionYears', 'action' => 'view', $hostelStudentAsset->session_year->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hostel Room Asset') ?></th>
            <td><?= $hostelStudentAsset->has('hostel_room_asset') ? $this->Html->link($hostelStudentAsset->hostel_room_asset->name, ['controller' => 'HostelRoomAssets', 'action' => 'view', $hostelStudentAsset->hostel_room_asset->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($hostelStudentAsset->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($hostelStudentAsset->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($hostelStudentAsset->quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($hostelStudentAsset->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($hostelStudentAsset->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($hostelStudentAsset->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($hostelStudentAsset->edited_on) ?></td>
        </tr>
    </table>
</div>
