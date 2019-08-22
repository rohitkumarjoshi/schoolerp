<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\State $state
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit State'), ['action' => 'edit', $state->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete State'), ['action' => 'delete', $state->id], ['confirm' => __('Are you sure you want to delete # {0}?', $state->id)]) ?> </li>
        <li><?= $this->Html->link(__('List States'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New State'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Student Infos'), ['controller' => 'StudentInfos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Info'), ['controller' => 'StudentInfos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="states view large-9 medium-8 columns content">
    <h3><?= h($state->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($state->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($state->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($state->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($state->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($state->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($state->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($state->edited_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Employees') ?></h4>
        <?php if (!empty($state->employees)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Username') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Dob') ?></th>
                <th scope="col"><?= __('Parmanent Address') ?></th>
                <th scope="col"><?= __('Correspondence Address') ?></th>
                <th scope="col"><?= __('Marital Status') ?></th>
                <th scope="col"><?= __('Gender Id') ?></th>
                <th scope="col"><?= __('City Id') ?></th>
                <th scope="col"><?= __('State Id') ?></th>
                <th scope="col"><?= __('Role Id') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($state->employees as $employees): ?>
            <tr>
                <td><?= h($employees->id) ?></td>
                <td><?= h($employees->username) ?></td>
                <td><?= h($employees->password) ?></td>
                <td><?= h($employees->name) ?></td>
                <td><?= h($employees->dob) ?></td>
                <td><?= h($employees->parmanent_address) ?></td>
                <td><?= h($employees->correspondence_address) ?></td>
                <td><?= h($employees->marital_status) ?></td>
                <td><?= h($employees->gender_id) ?></td>
                <td><?= h($employees->city_id) ?></td>
                <td><?= h($employees->state_id) ?></td>
                <td><?= h($employees->role_id) ?></td>
                <td><?= h($employees->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Employees', 'action' => 'view', $employees->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Employees', 'action' => 'edit', $employees->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Employees', 'action' => 'delete', $employees->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employees->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Student Infos') ?></h4>
        <?php if (!empty($state->student_infos)): ?>
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
            <?php foreach ($state->student_infos as $studentInfos): ?>
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
