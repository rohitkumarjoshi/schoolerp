<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SessionYear Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $from_date
 * @property \Cake\I18n\FrozenDate $to_date
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property string $status
 *
 * @property \App\Model\Entity\BookIssueReturn[] $book_issue_returns
 * @property \App\Model\Entity\ClassMapping[] $class_mappings
 * @property \App\Model\Entity\EnquiryFormStudent[] $enquiry_form_students
 * @property \App\Model\Entity\FeeMonthMapping[] $fee_month_mappings
 * @property \App\Model\Entity\FeeReceipt[] $fee_receipts
 * @property \App\Model\Entity\FeeTypeMaster[] $fee_type_masters
 * @property \App\Model\Entity\FeeTypeReceipt[] $fee_type_receipts
 * @property \App\Model\Entity\FeeTypeStudentMaster[] $fee_type_student_masters
 * @property \App\Model\Entity\Grn[] $grns
 * @property \App\Model\Entity\HostelAttendance[] $hostel_attendances
 * @property \App\Model\Entity\HostelGatePass[] $hostel_gate_passes
 * @property \App\Model\Entity\HostelRegistration[] $hostel_registrations
 * @property \App\Model\Entity\ItemIssueReturn[] $item_issue_returns
 * @property \App\Model\Entity\LibraryStudentInOut[] $library_student_in_outs
 * @property \App\Model\Entity\Medium[] $mediums
 * @property \App\Model\Entity\MonthlyFee[] $monthly_fees
 * @property \App\Model\Entity\PurchaseOrder[] $purchase_orders
 * @property \App\Model\Entity\PurchaseReturn[] $purchase_returns
 * @property \App\Model\Entity\Section[] $sections
 * @property \App\Model\Entity\StockLedger[] $stock_ledgers
 * @property \App\Model\Entity\Stream[] $streams
 * @property \App\Model\Entity\StudentAchivement[] $student_achivements
 * @property \App\Model\Entity\StudentClass[] $student_classes
 * @property \App\Model\Entity\StudentDocument[] $student_documents
 * @property \App\Model\Entity\StudentInfo[] $student_infos
 * @property \App\Model\Entity\StudentRedDiary[] $student_red_diaries
 * @property \App\Model\Entity\StudentSibling[] $student_siblings
 * @property \App\Model\Entity\Student[] $students
 * @property \App\Model\Entity\VehicleStudentAttendance[] $vehicle_student_attendances
 */
class SessionYear extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'from_date' => true,
        'to_date' => true,
        'session_name' => true,
        'session_year_name' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'status' => true,
        'book_issue_returns' => true,
        'class_mappings' => true,
        'enquiry_form_students' => true,
        'fee_month_mappings' => true,
        'fee_receipts' => true,
        'fee_type_masters' => true,
        'fee_type_receipts' => true,
        'fee_type_student_masters' => true,
        'grns' => true,
        'hostel_attendances' => true,
        'hostel_gate_passes' => true,
        'hostel_registrations' => true,
        'item_issue_returns' => true,
        'library_student_in_outs' => true,
        'mediums' => true,
        'monthly_fees' => true,
        'purchase_orders' => true,
        'purchase_returns' => true,
        'sections' => true,
        'stock_ledgers' => true,
        'streams' => true,
        'student_achivements' => true,
        'student_classes' => true,
        'student_documents' => true,
        'student_infos' => true,
        'student_red_diaries' => true,
        'student_siblings' => true,
        'students' => true,
        'vehicle_student_attendances' => true
    ];
}
