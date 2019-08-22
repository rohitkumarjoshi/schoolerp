<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EnquiryFormStudent Entity
 *
 * @property int $id
 * @property string $name
 * @property int $gender_id
 * @property string $father_name
 * @property string $mother_name
 * @property int $student_parent_profession_id
 * @property string $mobile_no
 * @property string $email
 * @property string $rte
 * @property int $student_class_id
 * @property int $medium_id
 * @property int $stream_id
 * @property string $last_school
 * @property int $last_medium_id
 * @property int $last_class_id
 * @property int $last_stream_id
 * @property string $percentage_in_last_class
 * @property string $board
 * @property string $permanent_address
 * @property string $correspondence_address
 * @property int $enquiry_no
 * @property int $session_year_id
 * @property string $enquiry_mode
 * @property \Cake\I18n\FrozenDate $dob
 * @property string $hostel_facility
 * @property int $reservation_category_id
 * @property int $pincode
 * @property string $local_gardian
 * @property string $gardian_address
 * @property int $gardian_pincode
 * @property string $gardian_mobile_no
 * @property string $transportaion
 * @property string $licence_no
 * @property \Cake\I18n\FrozenDate $exam_date
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $exam_time
 * @property string $enquiry_status
 * @property \Cake\I18n\FrozenDate $enquiry_date
 * @property \Cake\I18n\FrozenDate $admission_form_date
 * @property int $admission_form_no
 * @property string $admission_generated
 *
 * @property \App\Model\Entity\Gender $gender
 * @property \App\Model\Entity\StudentClass $student_class
 * @property \App\Model\Entity\Medium $medium
 * @property \App\Model\Entity\Stream $stream
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\Medium $last_medium
 * @property \App\Model\Entity\StudentClass $last_class
 * @property \App\Model\Entity\Stream $last_stream
 * @property \App\Model\Entity\FeeReceipt[] $fee_receipts
 */
class EnquiryFormStudent extends Entity
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
        'name' => true,
        'name_separate' => true,
        'entrance_exam_resulte' => true,
        'gender_id' => true,
        'father_name' => true,
        'mother_name' => true,
        'mobile_no' => true,
        'living' => true,
        'email' => true,
        'rte' => true,
        'student_class_id' => true,
        'medium_id' => true,
        'stream_id' => true,
        'last_school' => true,
        'last_medium_id' => true,
        'last_class_id' => true,
        'last_stream_id' => true,
        'percentage_in_last_class' => true,
        'board' => true,
        'permanent_address' => true,
        'correspondence_address' => true,
        'enquiry_no' => true,
        'session_year_id' => true,
        'enquiry_mode' => true,
        'dob' => true,
        'hostel_facility' => true,
        'reservation_category_id' => true,
        'minority' => true,
        'local_guardian' => true,
        'guardian_address' => true,
        'guardian_pincode' => true,
        'guardian_mobile_no' => true,
        'transportation' => true,
        'licence_no' => true,
        'exam_date' => true,
        'created_on' => true,
        'created_by' => true,
        'vehicle_station_id' => true,
        'vehicle_id' => true,
        'exam_time' => true,
        'enquiry_status' => true,
        'enquiry_date' => true,
        'admission_form_date' => true,
        'admission_form_no' => true,
        'admission_generated' => true,
        'gender' => true,
        'student_class' => true,
        'medium' => true,
        'stream' => true,
        'session_year' => true,
        'last_medium' => true,
        'last_class' => true,
        'last_stream' => true,
        'fee_receipts' => true,
        'student_documents' => true,
        'student_father_professions' => true,
        'student_mother_professions' => true
    ];
}
