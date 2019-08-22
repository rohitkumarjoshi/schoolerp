<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Student $student
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Student'), ['action' => 'edit', $student->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Student'), ['action' => 'delete', $student->id], ['confirm' => __('Are you sure you want to delete # {0}?', $student->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Genders'), ['controller' => 'Genders', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Gender'), ['controller' => 'Genders', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Disabilities'), ['controller' => 'Disabilities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Disability'), ['controller' => 'Disabilities', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Book Issue Returns'), ['controller' => 'BookIssueReturns', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Book Issue Return'), ['controller' => 'BookIssueReturns', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fee Receipts'), ['controller' => 'FeeReceipts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fee Receipt'), ['controller' => 'FeeReceipts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fee Type Student Masters'), ['controller' => 'FeeTypeStudentMasters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fee Type Student Master'), ['controller' => 'FeeTypeStudentMasters', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Hostel Attendances'), ['controller' => 'HostelAttendances', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hostel Attendance'), ['controller' => 'HostelAttendances', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Hostel Out Passes'), ['controller' => 'HostelOutPasses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hostel Out Pass'), ['controller' => 'HostelOutPasses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Hostel Registrations'), ['controller' => 'HostelRegistrations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hostel Registration'), ['controller' => 'HostelRegistrations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Hostel Student Assets'), ['controller' => 'HostelStudentAssets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hostel Student Asset'), ['controller' => 'HostelStudentAssets', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Item Issue Returns'), ['controller' => 'ItemIssueReturns', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Issue Return'), ['controller' => 'ItemIssueReturns', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Library Student In Outs'), ['controller' => 'LibraryStudentInOuts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Library Student In Out'), ['controller' => 'LibraryStudentInOuts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Mess Attendances'), ['controller' => 'MessAttendances', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mess Attendance'), ['controller' => 'MessAttendances', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Student Achivements'), ['controller' => 'StudentAchivements', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Achivement'), ['controller' => 'StudentAchivements', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Student Documents'), ['controller' => 'StudentDocuments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Document'), ['controller' => 'StudentDocuments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Student Infos'), ['controller' => 'StudentInfos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Info'), ['controller' => 'StudentInfos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Student Red Diaries'), ['controller' => 'StudentRedDiaries', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Red Diary'), ['controller' => 'StudentRedDiaries', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Student Siblings'), ['controller' => 'StudentSiblings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Sibling'), ['controller' => 'StudentSiblings', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vehicle Feedbacks'), ['controller' => 'VehicleFeedbacks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vehicle Feedback'), ['controller' => 'VehicleFeedbacks', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vehicle Student Attendances'), ['controller' => 'VehicleStudentAttendances', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vehicle Student Attendance'), ['controller' => 'VehicleStudentAttendances', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="students view large-9 medium-8 columns content">
    <h3><?= h($student->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($student->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Father Name') ?></th>
            <td><?= h($student->father_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mother Name') ?></th>
            <td><?= h($student->mother_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Scholar No') ?></th>
            <td><?= h($student->scholar_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gender') ?></th>
            <td><?= $student->has('gender') ? $this->Html->link($student->gender->name, ['controller' => 'Genders', 'action' => 'view', $student->gender->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nationality') ?></th>
            <td><?= h($student->nationality) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parent Mobile No') ?></th>
            <td><?= h($student->parent_mobile_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Student Mobile No') ?></th>
            <td><?= h($student->student_mobile_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Session Year') ?></th>
            <td><?= $student->has('session_year') ? $this->Html->link($student->session_year->id, ['controller' => 'SessionYears', 'action' => 'view', $student->session_year->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last School Name') ?></th>
            <td><?= h($student->last_school_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Disability') ?></th>
            <td><?= $student->has('disability') ? $this->Html->link($student->disability->name, ['controller' => 'Disabilities', 'action' => 'view', $student->disability->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Student Status') ?></th>
            <td><?= h($student->student_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Barcode No') ?></th>
            <td><?= h($student->barcode_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($student->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Admission Class Id') ?></th>
            <td><?= $this->Number->format($student->admission_class_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Admission Medium Id') ?></th>
            <td><?= $this->Number->format($student->admission_medium_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Admission Stream Id') ?></th>
            <td><?= $this->Number->format($student->admission_stream_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Class Id') ?></th>
            <td><?= $this->Number->format($student->last_class_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Stream Id') ?></th>
            <td><?= $this->Number->format($student->last_stream_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Medium Id') ?></th>
            <td><?= $this->Number->format($student->last_medium_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($student->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($student->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Registration Date') ?></th>
            <td><?= h($student->registration_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dob') ?></th>
            <td><?= h($student->dob) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Admission Date') ?></th>
            <td><?= h($student->admission_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('School Tc Date') ?></th>
            <td><?= h($student->school_tc_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($student->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($student->edited_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Book Issue Returns') ?></h4>
        <?php if (!empty($student->book_issue_returns)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Book Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Session Year Id') ?></th>
                <th scope="col"><?= __('Employee Id') ?></th>
                <th scope="col"><?= __('Date From') ?></th>
                <th scope="col"><?= __('Date To') ?></th>
                <th scope="col"><?= __('Return Date') ?></th>
                <th scope="col"><?= __('Late Day') ?></th>
                <th scope="col"><?= __('Fine Amount Per Day') ?></th>
                <th scope="col"><?= __('Fine Amount') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Payment Date') ?></th>
                <th scope="col"><?= __('Remark') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($student->book_issue_returns as $bookIssueReturns): ?>
            <tr>
                <td><?= h($bookIssueReturns->id) ?></td>
                <td><?= h($bookIssueReturns->book_id) ?></td>
                <td><?= h($bookIssueReturns->student_id) ?></td>
                <td><?= h($bookIssueReturns->session_year_id) ?></td>
                <td><?= h($bookIssueReturns->employee_id) ?></td>
                <td><?= h($bookIssueReturns->date_from) ?></td>
                <td><?= h($bookIssueReturns->date_to) ?></td>
                <td><?= h($bookIssueReturns->return_date) ?></td>
                <td><?= h($bookIssueReturns->late_day) ?></td>
                <td><?= h($bookIssueReturns->fine_amount_per_day) ?></td>
                <td><?= h($bookIssueReturns->fine_amount) ?></td>
                <td><?= h($bookIssueReturns->status) ?></td>
                <td><?= h($bookIssueReturns->payment_date) ?></td>
                <td><?= h($bookIssueReturns->remark) ?></td>
                <td><?= h($bookIssueReturns->created_on) ?></td>
                <td><?= h($bookIssueReturns->created_by) ?></td>
                <td><?= h($bookIssueReturns->edited_on) ?></td>
                <td><?= h($bookIssueReturns->edited_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'BookIssueReturns', 'action' => 'view', $bookIssueReturns->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'BookIssueReturns', 'action' => 'edit', $bookIssueReturns->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'BookIssueReturns', 'action' => 'delete', $bookIssueReturns->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bookIssueReturns->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Fee Receipts') ?></h4>
        <?php if (!empty($student->fee_receipts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Session Year Id') ?></th>
                <th scope="col"><?= __('Fee Type Master Id') ?></th>
                <th scope="col"><?= __('Enquiry Form Student Id') ?></th>
                <th scope="col"><?= __('Student Info Id') ?></th>
                <th scope="col"><?= __('Receipt No') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Fine Amount') ?></th>
                <th scope="col"><?= __('Concession Amount') ?></th>
                <th scope="col"><?= __('Total Amount') ?></th>
                <th scope="col"><?= __('Payment Type') ?></th>
                <th scope="col"><?= __('Payment Method') ?></th>
                <th scope="col"><?= __('Cheque No') ?></th>
                <th scope="col"><?= __('Cheque Date') ?></th>
                <th scope="col"><?= __('Transaction No') ?></th>
                <th scope="col"><?= __('Receipt Date') ?></th>
                <th scope="col"><?= __('Remark') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($student->fee_receipts as $feeReceipts): ?>
            <tr>
                <td><?= h($feeReceipts->id) ?></td>
                <td><?= h($feeReceipts->session_year_id) ?></td>
                <td><?= h($feeReceipts->fee_type_master_id) ?></td>
                <td><?= h($feeReceipts->enquiry_form_student_id) ?></td>
                <td><?= h($feeReceipts->student_info_id) ?></td>
                <td><?= h($feeReceipts->receipt_no) ?></td>
                <td><?= h($feeReceipts->amount) ?></td>
                <td><?= h($feeReceipts->fine_amount) ?></td>
                <td><?= h($feeReceipts->concession_amount) ?></td>
                <td><?= h($feeReceipts->total_amount) ?></td>
                <td><?= h($feeReceipts->payment_type) ?></td>
                <td><?= h($feeReceipts->payment_method) ?></td>
                <td><?= h($feeReceipts->cheque_no) ?></td>
                <td><?= h($feeReceipts->cheque_date) ?></td>
                <td><?= h($feeReceipts->transaction_no) ?></td>
                <td><?= h($feeReceipts->receipt_date) ?></td>
                <td><?= h($feeReceipts->remark) ?></td>
                <td><?= h($feeReceipts->created_on) ?></td>
                <td><?= h($feeReceipts->created_by) ?></td>
                <td><?= h($feeReceipts->edited_on) ?></td>
                <td><?= h($feeReceipts->edited_by) ?></td>
                <td><?= h($feeReceipts->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'FeeReceipts', 'action' => 'view', $feeReceipts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'FeeReceipts', 'action' => 'edit', $feeReceipts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'FeeReceipts', 'action' => 'delete', $feeReceipts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feeReceipts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Fee Type Student Masters') ?></h4>
        <?php if (!empty($student->fee_type_student_masters)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Fee Type Master Row Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Session Year Id') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($student->fee_type_student_masters as $feeTypeStudentMasters): ?>
            <tr>
                <td><?= h($feeTypeStudentMasters->id) ?></td>
                <td><?= h($feeTypeStudentMasters->fee_type_master_row_id) ?></td>
                <td><?= h($feeTypeStudentMasters->student_id) ?></td>
                <td><?= h($feeTypeStudentMasters->session_year_id) ?></td>
                <td><?= h($feeTypeStudentMasters->amount) ?></td>
                <td><?= h($feeTypeStudentMasters->created_on) ?></td>
                <td><?= h($feeTypeStudentMasters->created_by) ?></td>
                <td><?= h($feeTypeStudentMasters->edited_on) ?></td>
                <td><?= h($feeTypeStudentMasters->edited_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'FeeTypeStudentMasters', 'action' => 'view', $feeTypeStudentMasters->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'FeeTypeStudentMasters', 'action' => 'edit', $feeTypeStudentMasters->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'FeeTypeStudentMasters', 'action' => 'delete', $feeTypeStudentMasters->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feeTypeStudentMasters->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Hostel Attendances') ?></h4>
        <?php if (!empty($student->hostel_attendances)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Session Year Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Hostel Registration Id') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Time') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($student->hostel_attendances as $hostelAttendances): ?>
            <tr>
                <td><?= h($hostelAttendances->id) ?></td>
                <td><?= h($hostelAttendances->session_year_id) ?></td>
                <td><?= h($hostelAttendances->student_id) ?></td>
                <td><?= h($hostelAttendances->hostel_registration_id) ?></td>
                <td><?= h($hostelAttendances->date) ?></td>
                <td><?= h($hostelAttendances->time) ?></td>
                <td><?= h($hostelAttendances->created_on) ?></td>
                <td><?= h($hostelAttendances->created_by) ?></td>
                <td><?= h($hostelAttendances->edited_on) ?></td>
                <td><?= h($hostelAttendances->edited_by) ?></td>
                <td><?= h($hostelAttendances->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'HostelAttendances', 'action' => 'view', $hostelAttendances->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'HostelAttendances', 'action' => 'edit', $hostelAttendances->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'HostelAttendances', 'action' => 'delete', $hostelAttendances->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hostelAttendances->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Hostel Out Passes') ?></h4>
        <?php if (!empty($student->hostel_out_passes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Session Year Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Date From') ?></th>
                <th scope="col"><?= __('Date To') ?></th>
                <th scope="col"><?= __('In Time') ?></th>
                <th scope="col"><?= __('Out Time') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($student->hostel_out_passes as $hostelOutPasses): ?>
            <tr>
                <td><?= h($hostelOutPasses->id) ?></td>
                <td><?= h($hostelOutPasses->session_year_id) ?></td>
                <td><?= h($hostelOutPasses->student_id) ?></td>
                <td><?= h($hostelOutPasses->date_from) ?></td>
                <td><?= h($hostelOutPasses->date_to) ?></td>
                <td><?= h($hostelOutPasses->in_time) ?></td>
                <td><?= h($hostelOutPasses->out_time) ?></td>
                <td><?= h($hostelOutPasses->status) ?></td>
                <td><?= h($hostelOutPasses->created_on) ?></td>
                <td><?= h($hostelOutPasses->created_by) ?></td>
                <td><?= h($hostelOutPasses->edited_on) ?></td>
                <td><?= h($hostelOutPasses->edited_by) ?></td>
                <td><?= h($hostelOutPasses->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'HostelOutPasses', 'action' => 'view', $hostelOutPasses->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'HostelOutPasses', 'action' => 'edit', $hostelOutPasses->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'HostelOutPasses', 'action' => 'delete', $hostelOutPasses->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hostelOutPasses->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Hostel Registrations') ?></h4>
        <?php if (!empty($student->hostel_registrations)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Session Year Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Registration Date') ?></th>
                <th scope="col"><?= __('Registration No') ?></th>
                <th scope="col"><?= __('Hostel Id') ?></th>
                <th scope="col"><?= __('Room Id') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($student->hostel_registrations as $hostelRegistrations): ?>
            <tr>
                <td><?= h($hostelRegistrations->id) ?></td>
                <td><?= h($hostelRegistrations->session_year_id) ?></td>
                <td><?= h($hostelRegistrations->student_id) ?></td>
                <td><?= h($hostelRegistrations->registration_date) ?></td>
                <td><?= h($hostelRegistrations->registration_no) ?></td>
                <td><?= h($hostelRegistrations->hostel_id) ?></td>
                <td><?= h($hostelRegistrations->room_id) ?></td>
                <td><?= h($hostelRegistrations->created_on) ?></td>
                <td><?= h($hostelRegistrations->created_by) ?></td>
                <td><?= h($hostelRegistrations->edited_on) ?></td>
                <td><?= h($hostelRegistrations->edited_by) ?></td>
                <td><?= h($hostelRegistrations->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'HostelRegistrations', 'action' => 'view', $hostelRegistrations->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'HostelRegistrations', 'action' => 'edit', $hostelRegistrations->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'HostelRegistrations', 'action' => 'delete', $hostelRegistrations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hostelRegistrations->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Hostel Student Assets') ?></h4>
        <?php if (!empty($student->hostel_student_assets)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Session Year Id') ?></th>
                <th scope="col"><?= __('Hostel Room Asset Id') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($student->hostel_student_assets as $hostelStudentAssets): ?>
            <tr>
                <td><?= h($hostelStudentAssets->id) ?></td>
                <td><?= h($hostelStudentAssets->student_id) ?></td>
                <td><?= h($hostelStudentAssets->session_year_id) ?></td>
                <td><?= h($hostelStudentAssets->hostel_room_asset_id) ?></td>
                <td><?= h($hostelStudentAssets->quantity) ?></td>
                <td><?= h($hostelStudentAssets->status) ?></td>
                <td><?= h($hostelStudentAssets->created_on) ?></td>
                <td><?= h($hostelStudentAssets->created_by) ?></td>
                <td><?= h($hostelStudentAssets->edited_on) ?></td>
                <td><?= h($hostelStudentAssets->edited_by) ?></td>
                <td><?= h($hostelStudentAssets->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'HostelStudentAssets', 'action' => 'view', $hostelStudentAssets->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'HostelStudentAssets', 'action' => 'edit', $hostelStudentAssets->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'HostelStudentAssets', 'action' => 'delete', $hostelStudentAssets->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hostelStudentAssets->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Item Issue Returns') ?></h4>
        <?php if (!empty($student->item_issue_returns)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Session Year Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Employee Id') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Transaction Date') ?></th>
                <th scope="col"><?= __('Grand Total') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($student->item_issue_returns as $itemIssueReturns): ?>
            <tr>
                <td><?= h($itemIssueReturns->id) ?></td>
                <td><?= h($itemIssueReturns->session_year_id) ?></td>
                <td><?= h($itemIssueReturns->student_id) ?></td>
                <td><?= h($itemIssueReturns->employee_id) ?></td>
                <td><?= h($itemIssueReturns->status) ?></td>
                <td><?= h($itemIssueReturns->transaction_date) ?></td>
                <td><?= h($itemIssueReturns->grand_total) ?></td>
                <td><?= h($itemIssueReturns->created_on) ?></td>
                <td><?= h($itemIssueReturns->created_by) ?></td>
                <td><?= h($itemIssueReturns->edited_on) ?></td>
                <td><?= h($itemIssueReturns->edited_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ItemIssueReturns', 'action' => 'view', $itemIssueReturns->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ItemIssueReturns', 'action' => 'edit', $itemIssueReturns->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ItemIssueReturns', 'action' => 'delete', $itemIssueReturns->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemIssueReturns->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Library Student In Outs') ?></h4>
        <?php if (!empty($student->library_student_in_outs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Session Year Id') ?></th>
                <th scope="col"><?= __('In Date') ?></th>
                <th scope="col"><?= __('In Time') ?></th>
                <th scope="col"><?= __('Out Date') ?></th>
                <th scope="col"><?= __('Out Time') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($student->library_student_in_outs as $libraryStudentInOuts): ?>
            <tr>
                <td><?= h($libraryStudentInOuts->id) ?></td>
                <td><?= h($libraryStudentInOuts->student_id) ?></td>
                <td><?= h($libraryStudentInOuts->session_year_id) ?></td>
                <td><?= h($libraryStudentInOuts->in_date) ?></td>
                <td><?= h($libraryStudentInOuts->in_time) ?></td>
                <td><?= h($libraryStudentInOuts->out_date) ?></td>
                <td><?= h($libraryStudentInOuts->out_time) ?></td>
                <td><?= h($libraryStudentInOuts->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'LibraryStudentInOuts', 'action' => 'view', $libraryStudentInOuts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'LibraryStudentInOuts', 'action' => 'edit', $libraryStudentInOuts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'LibraryStudentInOuts', 'action' => 'delete', $libraryStudentInOuts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $libraryStudentInOuts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Mess Attendances') ?></h4>
        <?php if (!empty($student->mess_attendances)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Session Year Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Meal Type Id') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Time') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($student->mess_attendances as $messAttendances): ?>
            <tr>
                <td><?= h($messAttendances->id) ?></td>
                <td><?= h($messAttendances->session_year_id) ?></td>
                <td><?= h($messAttendances->student_id) ?></td>
                <td><?= h($messAttendances->meal_type_id) ?></td>
                <td><?= h($messAttendances->date) ?></td>
                <td><?= h($messAttendances->time) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'MessAttendances', 'action' => 'view', $messAttendances->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'MessAttendances', 'action' => 'edit', $messAttendances->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'MessAttendances', 'action' => 'delete', $messAttendances->id], ['confirm' => __('Are you sure you want to delete # {0}?', $messAttendances->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Student Achivements') ?></h4>
        <?php if (!empty($student->student_achivements)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Session Year Id') ?></th>
                <th scope="col"><?= __('Achivement Category Id') ?></th>
                <th scope="col"><?= __('Achivement Type') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($student->student_achivements as $studentAchivements): ?>
            <tr>
                <td><?= h($studentAchivements->id) ?></td>
                <td><?= h($studentAchivements->session_year_id) ?></td>
                <td><?= h($studentAchivements->achivement_category_id) ?></td>
                <td><?= h($studentAchivements->achivement_type) ?></td>
                <td><?= h($studentAchivements->student_id) ?></td>
                <td><?= h($studentAchivements->description) ?></td>
                <td><?= h($studentAchivements->created_on) ?></td>
                <td><?= h($studentAchivements->created_by) ?></td>
                <td><?= h($studentAchivements->edited_on) ?></td>
                <td><?= h($studentAchivements->edited_by) ?></td>
                <td><?= h($studentAchivements->is_deleted) ?></td>
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
    <div class="related">
        <h4><?= __('Related Student Documents') ?></h4>
        <?php if (!empty($student->student_documents)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Session Year Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Document Id') ?></th>
                <th scope="col"><?= __('Image Path') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($student->student_documents as $studentDocuments): ?>
            <tr>
                <td><?= h($studentDocuments->id) ?></td>
                <td><?= h($studentDocuments->session_year_id) ?></td>
                <td><?= h($studentDocuments->student_id) ?></td>
                <td><?= h($studentDocuments->document_id) ?></td>
                <td><?= h($studentDocuments->image_path) ?></td>
                <td><?= h($studentDocuments->created_on) ?></td>
                <td><?= h($studentDocuments->created_by) ?></td>
                <td><?= h($studentDocuments->edited_on) ?></td>
                <td><?= h($studentDocuments->edited_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'StudentDocuments', 'action' => 'view', $studentDocuments->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'StudentDocuments', 'action' => 'edit', $studentDocuments->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'StudentDocuments', 'action' => 'delete', $studentDocuments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentDocuments->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Student Infos') ?></h4>
        <?php if (!empty($student->student_infos)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Parmanent Address') ?></th>
                <th scope="col"><?= __('Correspondence Address') ?></th>
                <th scope="col"><?= __('Role No') ?></th>
                <th scope="col"><?= __('Hostel Facility') ?></th>
                <th scope="col"><?= __('Fee Type Role Id') ?></th>
                <th scope="col"><?= __('Vehicle Station Id') ?></th>
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
            <?php foreach ($student->student_infos as $studentInfos): ?>
            <tr>
                <td><?= h($studentInfos->id) ?></td>
                <td><?= h($studentInfos->student_id) ?></td>
                <td><?= h($studentInfos->parmanent_address) ?></td>
                <td><?= h($studentInfos->correspondence_address) ?></td>
                <td><?= h($studentInfos->role_no) ?></td>
                <td><?= h($studentInfos->hostel_facility) ?></td>
                <td><?= h($studentInfos->fee_type_role_id) ?></td>
                <td><?= h($studentInfos->vehicle_station_id) ?></td>
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
    <div class="related">
        <h4><?= __('Related Student Red Diaries') ?></h4>
        <?php if (!empty($student->student_red_diaries)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Session Year Id') ?></th>
                <th scope="col"><?= __('Reason') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Punished By') ?></th>
                <th scope="col"><?= __('Punished From') ?></th>
                <th scope="col"><?= __('Punished To') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($student->student_red_diaries as $studentRedDiaries): ?>
            <tr>
                <td><?= h($studentRedDiaries->id) ?></td>
                <td><?= h($studentRedDiaries->student_id) ?></td>
                <td><?= h($studentRedDiaries->session_year_id) ?></td>
                <td><?= h($studentRedDiaries->reason) ?></td>
                <td><?= h($studentRedDiaries->description) ?></td>
                <td><?= h($studentRedDiaries->punished_by) ?></td>
                <td><?= h($studentRedDiaries->punished_from) ?></td>
                <td><?= h($studentRedDiaries->punished_to) ?></td>
                <td><?= h($studentRedDiaries->created_on) ?></td>
                <td><?= h($studentRedDiaries->created_by) ?></td>
                <td><?= h($studentRedDiaries->edited_on) ?></td>
                <td><?= h($studentRedDiaries->edited_by) ?></td>
                <td><?= h($studentRedDiaries->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'StudentRedDiaries', 'action' => 'view', $studentRedDiaries->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'StudentRedDiaries', 'action' => 'edit', $studentRedDiaries->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'StudentRedDiaries', 'action' => 'delete', $studentRedDiaries->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentRedDiaries->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Student Siblings') ?></h4>
        <?php if (!empty($student->student_siblings)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Sibling Id') ?></th>
                <th scope="col"><?= __('Session Year Id') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($student->student_siblings as $studentSiblings): ?>
            <tr>
                <td><?= h($studentSiblings->id) ?></td>
                <td><?= h($studentSiblings->student_id) ?></td>
                <td><?= h($studentSiblings->sibling_id) ?></td>
                <td><?= h($studentSiblings->session_year_id) ?></td>
                <td><?= h($studentSiblings->created_on) ?></td>
                <td><?= h($studentSiblings->created_by) ?></td>
                <td><?= h($studentSiblings->edited_on) ?></td>
                <td><?= h($studentSiblings->edited_by) ?></td>
                <td><?= h($studentSiblings->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'StudentSiblings', 'action' => 'view', $studentSiblings->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'StudentSiblings', 'action' => 'edit', $studentSiblings->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'StudentSiblings', 'action' => 'delete', $studentSiblings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentSiblings->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Vehicle Feedbacks') ?></h4>
        <?php if (!empty($student->vehicle_feedbacks)): ?>
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
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($student->vehicle_feedbacks as $vehicleFeedbacks): ?>
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
                <td><?= h($vehicleFeedbacks->is_deleted) ?></td>
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
        <h4><?= __('Related Vehicle Student Attendances') ?></h4>
        <?php if (!empty($student->vehicle_student_attendances)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Session Year Id') ?></th>
                <th scope="col"><?= __('Vehicle Id') ?></th>
                <th scope="col"><?= __('In Time') ?></th>
                <th scope="col"><?= __('Out Time') ?></th>
                <th scope="col"><?= __('Taken By') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($student->vehicle_student_attendances as $vehicleStudentAttendances): ?>
            <tr>
                <td><?= h($vehicleStudentAttendances->id) ?></td>
                <td><?= h($vehicleStudentAttendances->student_id) ?></td>
                <td><?= h($vehicleStudentAttendances->session_year_id) ?></td>
                <td><?= h($vehicleStudentAttendances->vehicle_id) ?></td>
                <td><?= h($vehicleStudentAttendances->in_time) ?></td>
                <td><?= h($vehicleStudentAttendances->out_time) ?></td>
                <td><?= h($vehicleStudentAttendances->taken_by) ?></td>
                <td><?= h($vehicleStudentAttendances->date) ?></td>
                <td><?= h($vehicleStudentAttendances->created_on) ?></td>
                <td><?= h($vehicleStudentAttendances->created_by) ?></td>
                <td><?= h($vehicleStudentAttendances->edited_on) ?></td>
                <td><?= h($vehicleStudentAttendances->edited_by) ?></td>
                <td><?= h($vehicleStudentAttendances->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'VehicleStudentAttendances', 'action' => 'view', $vehicleStudentAttendances->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'VehicleStudentAttendances', 'action' => 'edit', $vehicleStudentAttendances->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'VehicleStudentAttendances', 'action' => 'delete', $vehicleStudentAttendances->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vehicleStudentAttendances->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
