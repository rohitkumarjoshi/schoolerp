<div class="related">
        <h4><?= __('Related Expenses') ?></h4>
        <?php if (!empty($vehicle->expenses)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Expense Category Id') ?></th>
                <th scope="col"><?= __('Expense Subcategory Id') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Vehicle Id') ?></th>
                <th scope="col"><?= __('Expense By') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Remark') ?></th>
                <th scope="col"><?= __('Payment Type Id') ?></th>
                <th scope="col"><?= __('Cheque No') ?></th>
                <th scope="col"><?= __('Cheque Date') ?></th>
                <th scope="col"><?= __('Bank Name') ?></th>
                <th scope="col"><?= __('Bank Remarks') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($vehicle->expenses as $expenses): ?>
            <tr>
                <td><?= h($expenses->id) ?></td>
                <td><?= h($expenses->expense_category_id) ?></td>
                <td><?= h($expenses->expense_subcategory_id) ?></td>
                <td><?= h($expenses->amount) ?></td>
                <td><?= h($expenses->vehicle_id) ?></td>
                <td><?= h($expenses->expense_by) ?></td>
                <td><?= h($expenses->date) ?></td>
                <td><?= h($expenses->remark) ?></td>
                <td><?= h($expenses->payment_type_id) ?></td>
                <td><?= h($expenses->cheque_no) ?></td>
                <td><?= h($expenses->cheque_date) ?></td>
                <td><?= h($expenses->bank_name) ?></td>
                <td><?= h($expenses->bank_remarks) ?></td>
                <td><?= h($expenses->created_on) ?></td>
                <td><?= h($expenses->created_by) ?></td>
                <td><?= h($expenses->edited_on) ?></td>
                <td><?= h($expenses->edited_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Expenses', 'action' => 'view', $expenses->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Expenses', 'action' => 'edit', $expenses->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Expenses', 'action' => 'delete', $expenses->id], ['confirm' => __('Are you sure you want to delete # {0}?', $expenses->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Student Infos') ?></h4>
        <?php if (!empty($vehicle->student_infos)): ?>
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
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($vehicle->student_infos as $studentInfos): ?>
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
    <div class="related">
        <h4><?= __('Related Vehicle Driver Mappings') ?></h4>
        <?php if (!empty($vehicle->vehicle_driver_mappings)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Vehicle Id') ?></th>
                <th scope="col"><?= __('Driver Id') ?></th>
                <th scope="col"><?= __('Conductor Id') ?></th>
                <th scope="col"><?= __('Assign Date') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($vehicle->vehicle_driver_mappings as $vehicleDriverMappings): ?>
            <tr>
                <td><?= h($vehicleDriverMappings->id) ?></td>
                <td><?= h($vehicleDriverMappings->vehicle_id) ?></td>
                <td><?= h($vehicleDriverMappings->driver_id) ?></td>
                <td><?= h($vehicleDriverMappings->conductor_id) ?></td>
                <td><?= h($vehicleDriverMappings->assign_date) ?></td>
                <td><?= h($vehicleDriverMappings->created_on) ?></td>
                <td><?= h($vehicleDriverMappings->created_by) ?></td>
                <td><?= h($vehicleDriverMappings->edited_on) ?></td>
                <td><?= h($vehicleDriverMappings->edited_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'VehicleDriverMappings', 'action' => 'view', $vehicleDriverMappings->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'VehicleDriverMappings', 'action' => 'edit', $vehicleDriverMappings->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'VehicleDriverMappings', 'action' => 'delete', $vehicleDriverMappings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vehicleDriverMappings->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Vehicle Feedbacks') ?></h4>
        <?php if (!empty($vehicle->vehicle_feedbacks)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Vehicle Id') ?></th>
                <th scope="col"><?= __('Driver Id') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Comment') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($vehicle->vehicle_feedbacks as $vehicleFeedbacks): ?>
            <tr>
                <td><?= h($vehicleFeedbacks->id) ?></td>
                <td><?= h($vehicleFeedbacks->student_id) ?></td>
                <td><?= h($vehicleFeedbacks->vehicle_id) ?></td>
                <td><?= h($vehicleFeedbacks->driver_id) ?></td>
                <td><?= h($vehicleFeedbacks->date) ?></td>
                <td><?= h($vehicleFeedbacks->comment) ?></td>
                <td><?= h($vehicleFeedbacks->created_on) ?></td>
                <td><?= h($vehicleFeedbacks->created_by) ?></td>
                <td><?= h($vehicleFeedbacks->edited_on) ?></td>
                <td><?= h($vehicleFeedbacks->edited_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'VehicleFeedbacks', 'action' => 'view', $vehicleFeedbacks->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'VehicleFeedbacks', 'action' => 'edit', $vehicleFeedbacks->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'VehicleFeedbacks', 'action' => 'delete', $vehicleFeedbacks->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vehicleFeedbacks->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Vehicle Fuel Entries') ?></h4>
        <?php if (!empty($vehicle->vehicle_fuel_entries)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Fill Date') ?></th>
                <th scope="col"><?= __('Filled By') ?></th>
                <th scope="col"><?= __('Vehicle Id') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Previous Km') ?></th>
                <th scope="col"><?= __('Current Km') ?></th>
                <th scope="col"><?= __('Liter') ?></th>
                <th scope="col"><?= __('Milege') ?></th>
                <th scope="col"><?= __('Bill No') ?></th>
                <th scope="col"><?= __('Remark') ?></th>
                <th scope="col"><?= __('Difference Km') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($vehicle->vehicle_fuel_entries as $vehicleFuelEntries): ?>
            <tr>
                <td><?= h($vehicleFuelEntries->id) ?></td>
                <td><?= h($vehicleFuelEntries->fill_date) ?></td>
                <td><?= h($vehicleFuelEntries->filled_by) ?></td>
                <td><?= h($vehicleFuelEntries->vehicle_id) ?></td>
                <td><?= h($vehicleFuelEntries->amount) ?></td>
                <td><?= h($vehicleFuelEntries->previous_km) ?></td>
                <td><?= h($vehicleFuelEntries->current_km) ?></td>
                <td><?= h($vehicleFuelEntries->liter) ?></td>
                <td><?= h($vehicleFuelEntries->milege) ?></td>
                <td><?= h($vehicleFuelEntries->bill_no) ?></td>
                <td><?= h($vehicleFuelEntries->remark) ?></td>
                <td><?= h($vehicleFuelEntries->difference_km) ?></td>
                <td><?= h($vehicleFuelEntries->created_on) ?></td>
                <td><?= h($vehicleFuelEntries->created_by) ?></td>
                <td><?= h($vehicleFuelEntries->edited_on) ?></td>
                <td><?= h($vehicleFuelEntries->edited_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'VehicleFuelEntries', 'action' => 'view', $vehicleFuelEntries->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'VehicleFuelEntries', 'action' => 'edit', $vehicleFuelEntries->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'VehicleFuelEntries', 'action' => 'delete', $vehicleFuelEntries->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vehicleFuelEntries->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Vehicle Routes') ?></h4>
        <?php if (!empty($vehicle->vehicle_routes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Vehicle Id') ?></th>
                <th scope="col"><?= __('Vehicle Station Id') ?></th>
                <th scope="col"><?= __('Pickup Time') ?></th>
                <th scope="col"><?= __('Drop Time') ?></th>
                <th scope="col"><?= __('Station Order By') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($vehicle->vehicle_routes as $vehicleRoutes): ?>
            <tr>
                <td><?= h($vehicleRoutes->id) ?></td>
                <td><?= h($vehicleRoutes->vehicle_id) ?></td>
                <td><?= h($vehicleRoutes->vehicle_station_id) ?></td>
                <td><?= h($vehicleRoutes->pickup_time) ?></td>
                <td><?= h($vehicleRoutes->drop_time) ?></td>
                <td><?= h($vehicleRoutes->station_order_by) ?></td>
                <td><?= h($vehicleRoutes->created_on) ?></td>
                <td><?= h($vehicleRoutes->created_by) ?></td>
                <td><?= h($vehicleRoutes->edited_on) ?></td>
                <td><?= h($vehicleRoutes->edited_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'VehicleRoutes', 'action' => 'view', $vehicleRoutes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'VehicleRoutes', 'action' => 'edit', $vehicleRoutes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'VehicleRoutes', 'action' => 'delete', $vehicleRoutes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vehicleRoutes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Vehicle Services') ?></h4>
        <?php if (!empty($vehicle->vehicle_services)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Vehicle Id') ?></th>
                <th scope="col"><?= __('Driver Id') ?></th>
                <th scope="col"><?= __('Service Date') ?></th>
                <th scope="col"><?= __('Km') ?></th>
                <th scope="col"><?= __('Bill No') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Vendor Id') ?></th>
                <th scope="col"><?= __('Next Service') ?></th>
                <th scope="col"><?= __('Remark') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($vehicle->vehicle_services as $vehicleServices): ?>
            <tr>
                <td><?= h($vehicleServices->id) ?></td>
                <td><?= h($vehicleServices->vehicle_id) ?></td>
                <td><?= h($vehicleServices->driver_id) ?></td>
                <td><?= h($vehicleServices->service_date) ?></td>
                <td><?= h($vehicleServices->km) ?></td>
                <td><?= h($vehicleServices->bill_no) ?></td>
                <td><?= h($vehicleServices->amount) ?></td>
                <td><?= h($vehicleServices->vendor_id) ?></td>
                <td><?= h($vehicleServices->next_service) ?></td>
                <td><?= h($vehicleServices->remark) ?></td>
                <td><?= h($vehicleServices->created_on) ?></td>
                <td><?= h($vehicleServices->created_by) ?></td>
                <td><?= h($vehicleServices->edited_on) ?></td>
                <td><?= h($vehicleServices->edited_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'VehicleServices', 'action' => 'view', $vehicleServices->]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'VehicleServices', 'action' => 'edit', $vehicleServices->]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'VehicleServices', 'action' => 'delete', $vehicleServices->], ['confirm' => __('Are you sure you want to delete # {0}?', $vehicleServices->)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Vehicle Student Attendances') ?></h4>
        <?php if (!empty($vehicle->vehicle_student_attendances)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Vehicle Id') ?></th>
                <th scope="col"><?= __('In Time') ?></th>
                <th scope="col"><?= __('Out Time') ?></th>
                <th scope="col"><?= __('Taken By') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($vehicle->vehicle_student_attendances as $vehicleStudentAttendances): ?>
            <tr>
                <td><?= h($vehicleStudentAttendances->id) ?></td>
                <td><?= h($vehicleStudentAttendances->student_id) ?></td>
                <td><?= h($vehicleStudentAttendances->vehicle_id) ?></td>
                <td><?= h($vehicleStudentAttendances->in_time) ?></td>
                <td><?= h($vehicleStudentAttendances->out_time) ?></td>
                <td><?= h($vehicleStudentAttendances->taken_by) ?></td>
                <td><?= h($vehicleStudentAttendances->date) ?></td>
                <td><?= h($vehicleStudentAttendances->created_on) ?></td>
                <td><?= h($vehicleStudentAttendances->created_by) ?></td>
                <td><?= h($vehicleStudentAttendances->edited_on) ?></td>
                <td><?= h($vehicleStudentAttendances->edited_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'VehicleStudentAttendances', 'action' => 'view', $vehicleStudentAttendances->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'VehicleStudentAttendances', 'action' => 'edit', $vehicleStudentAttendances->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'VehicleStudentAttendances', 'action' => 'delete', $vehicleStudentAttendances->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vehicleStudentAttendances->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>