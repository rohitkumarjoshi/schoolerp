<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Student Entity
 *
 * @property int $id
 * @property string $name
 * @property string $father_name
 * @property string $mother_name
 * @property string $scholar_no
 * @property \Cake\I18n\FrozenDate $registration_date
 * @property \Cake\I18n\FrozenDate $dob
 * @property int $gender_id
 * @property string $nationality
 * @property string $parent_mobile_no
 * @property string $student_mobile_no
 * @property int $session_year_id
 * @property int $admission_class_id
 * @property \Cake\I18n\FrozenDate $admission_date
 * @property int $admission_medium_id
 * @property int $admission_stream_id
 * @property string $last_school_name
 * @property int $disability_id
 * @property \Cake\I18n\FrozenDate $school_tc_date
 * @property string $student_status
 * @property int $last_class_id
 * @property int $last_stream_id
 * @property int $last_medium_id
 * @property string $barcode_no
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 *
 * @property \App\Model\Entity\Gender $gender
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\AdmissionClass $admission_class
 * @property \App\Model\Entity\AdmissionMedia $admission_media
 * @property \App\Model\Entity\AdmissionStream $admission_stream
 * @property \App\Model\Entity\Disability $disability
 * @property \App\Model\Entity\LastClass $last_class
 * @property \App\Model\Entity\LastStream $last_stream
 * @property \App\Model\Entity\LastMedia $last_media
 * @property \App\Model\Entity\BookIssueReturn[] $book_issue_returns
 * @property \App\Model\Entity\FeeReceipt[] $fee_receipts
 * @property \App\Model\Entity\FeeTypeStudentMaster[] $fee_type_student_masters
 * @property \App\Model\Entity\HostelAttendance[] $hostel_attendances
 * @property \App\Model\Entity\HostelOutPass[] $hostel_out_passes
 * @property \App\Model\Entity\HostelRegistration[] $hostel_registrations
 * @property \App\Model\Entity\HostelStudentAsset[] $hostel_student_assets
 * @property \App\Model\Entity\ItemIssueReturn[] $item_issue_returns
 * @property \App\Model\Entity\LibraryStudentInOut[] $library_student_in_outs
 * @property \App\Model\Entity\MessAttendance[] $mess_attendances
 * @property \App\Model\Entity\StudentAchivement[] $student_achivements
 * @property \App\Model\Entity\StudentDocument[] $student_documents
 * @property \App\Model\Entity\StudentInfo[] $student_infos
 * @property \App\Model\Entity\StudentRedDiary[] $student_red_diaries
 * @property \App\Model\Entity\StudentSibling[] $student_siblings
 * @property \App\Model\Entity\VehicleFeedback[] $vehicle_feedbacks
 * @property \App\Model\Entity\VehicleStudentAttendance[] $vehicle_student_attendances
 */
class Student extends Entity
{

    protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher())->hash($password);
    }
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
        '*' => true,
        'name' => true,
        'name_separate' => true,
        'enquiry_form_student_id' => true,
        'admission_by' => true,
        'father_name' => true,
        'mother_name' => true,
        'scholar_no' => true,
        'registration_date' => true,
        'dob' => true,
        'gender_id' => true,
        'nationality' => true,
        'parent_mobile_no' => true,
        'student_mobile_no' => true,
        'session_year_id' => true,
        'admission_class_id' => true,
        'admission_medium_id' => true,
        'admission_stream_id' => true,
        'disability_id' => true,
        'barcode_no' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'gender' => true,
        'session_year' => true,
        'admission_class' => true,
        'admission_media' => true,
        'admission_stream' => true,
        'disability' => true,
        'last_class' => true,
        'last_stream' => true,
        'last_media' => true,
        'book_issue_returns' => true,
        'fee_receipts' => true,
        'fee_type_student_masters' => true,
        'hostel_attendances' => true,
        'hostel_out_passes' => true,
        'hostel_registrations' => true,
        'hostel_student_assets' => true,
        'item_issue_returns' => true,
        'library_student_in_outs' => true,
        'mess_attendances' => true,
        'student_achivements' => true,
        'student_documents' => true,
        'student_infos' => true,
        'student_red_diaries' => true,
        'student_siblings' => true,
        'vehicle_feedbacks' => true,
        'enquiry_form_students' => true,
        'vehicle_student_attendances' => true,
        'last_school' => true,
        'last_medium_id' => true,
        'last_class_id' => true,
        'last_stream_id' => true,
        'percentage_in_last_class' => true,
        'board' => true,
        'last_medium' => true,
        'last_class' => true,
        'last_stream' => true
    ];
    protected $_hidden = [
        'password'
    ];
}
