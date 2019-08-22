<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Caste $caste
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Caste'), ['action' => 'edit', $caste->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Caste'), ['action' => 'delete', $caste->id], ['confirm' => __('Are you sure you want to delete # {0}?', $caste->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Castes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Caste'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Student Infos'), ['controller' => 'StudentInfos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Info'), ['controller' => 'StudentInfos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="castes view large-9 medium-8 columns content">
    <h3><?= h($caste->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($caste->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($caste->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($caste->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($caste->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($caste->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($caste->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($caste->edited_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Student Infos') ?></h4>
        <?php if (!empty($caste->student_infos)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Parmanent Address') ?></th>
                <th scope="col"><?= __('Correspondence Address') ?></th>
                <th scope="col"><?= __('Role No') ?></th>
                <th scope="col"><?= __('Bus Facility') ?></th>
                <th scope="col"><?= __('Bus Station Id') ?></th>
                <th scope="col"><?= __('Reservation Category Id') ?></th>
                <th scope="col"><?= __('State Id') ?></th>
                <th scope="col"><?= __('City Id') ?></th>
                <th scope="col"><?= __('Pincode') ?></th>
                <th scope="col"><?= __('Session Year Id') ?></th>
                <th scope="col"><?= __('Rte') ?></th>
                <th scope="col"><?= __('Aadhaar No') ?></th>
                <th scope="col"><?= __('Caste Id') ?></th>
                <th scope="col"><?= __('Religion Id') ?></th>
                <th scope="col"><?= __('Student Class Id') ?></th>
                <th scope="col"><?= __('Medium Id') ?></th>
                <th scope="col"><?= __('Section Id') ?></th>
                <th scope="col"><?= __('Stream Id') ?></th>
                <th scope="col"><?= __('House Id') ?></th>
                <th scope="col"><?= __('Student Parent Profession Id') ?></th>
                <th scope="col"><?= __('Vehicle Id') ?></th>
                <th scope="col"><?= __('Hostel Id') ?></th>
                <th scope="col"><?= __('Room Id') ?></th>
                <th scope="col"><?= __('Hostel Tc Nodues') ?></th>
                <th scope="col"><?= __('Hostel Tc Date') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($caste->student_infos as $studentInfos): ?>
            <tr>
                <td><?= h($studentInfos->id) ?></td>
                <td><?= h($studentInfos->student_id) ?></td>
                <td><?= h($studentInfos->parmanent_address) ?></td>
                <td><?= h($studentInfos->correspondence_address) ?></td>
                <td><?= h($studentInfos->role_no) ?></td>
                <td><?= h($studentInfos->bus_facility) ?></td>
                <td><?= h($studentInfos->bus_station_id) ?></td>
                <td><?= h($studentInfos->reservation_category_id) ?></td>
                <td><?= h($studentInfos->state_id) ?></td>
                <td><?= h($studentInfos->city_id) ?></td>
                <td><?= h($studentInfos->pincode) ?></td>
                <td><?= h($studentInfos->session_year_id) ?></td>
                <td><?= h($studentInfos->rte) ?></td>
                <td><?= h($studentInfos->aadhaar_no) ?></td>
                <td><?= h($studentInfos->caste_id) ?></td>
                <td><?= h($studentInfos->religion_id) ?></td>
                <td><?= h($studentInfos->student_class_id) ?></td>
                <td><?= h($studentInfos->medium_id) ?></td>
                <td><?= h($studentInfos->section_id) ?></td>
                <td><?= h($studentInfos->stream_id) ?></td>
                <td><?= h($studentInfos->house_id) ?></td>
                <td><?= h($studentInfos->student_parent_profession_id) ?></td>
                <td><?= h($studentInfos->vehicle_id) ?></td>
                <td><?= h($studentInfos->hostel_id) ?></td>
                <td><?= h($studentInfos->room_id) ?></td>
                <td><?= h($studentInfos->hostel_tc_nodues) ?></td>
                <td><?= h($studentInfos->hostel_tc_date) ?></td>
                <td><?= h($studentInfos->created_on) ?></td>
                <td><?= h($studentInfos->created_by) ?></td>
                <td><?= h($studentInfos->edited_on) ?></td>
                <td><?= h($studentInfos->edited_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'StudentInfos', 'action' => 'view', $studentInfos->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'StudentInfos', 'action' => 'edit', $studentInfos->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'StudentInfos', 'action' => 'delete', $studentInfos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentInfos->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
