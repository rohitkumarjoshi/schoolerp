<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TransferCertificate Entity
 *
 * @property int $id
 * @property int $student_id
 * @property int $session_year_id
 * @property string $tc_type
 * @property \Cake\I18n\FrozenDate $tc_apply_date
 * @property \Cake\I18n\FrozenDate $tc_issue_date
 * @property string $book_no
 * @property int $tc_serial_no
 * @property string $tc_status
 * @property string $tc_reason
 * @property string $school_board
 * @property string $fail
 * @property string $subject
 * @property string $higher_promotion
 * @property string $dues_paid
 * @property string $concession
 * @property float $working_day_last_class
 * @property float $present_day_last_class
 * @property string $ncc_cadet
 * @property string $general_conduct
 * @property string $other_remark
 * @property string $result_status
 * @property string $extra_curricular_activity
 * @property string $extra_curricular_activity_name
 * @property string $achievement
 *
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\SessionYear $session_year
 */
class TransferCertificate extends Entity
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
        'student_id' => true,
        'session_year_id' => true,
        'tc_type' => true,
        'tc_apply_date' => true,
        'tc_issue_date' => true,
        'book_no' => true,
        'tc_serial_no' => true,
        'tc_status' => true,
        'tc_reason' => true,
        'school_board' => true,
        'fail' => true,
        'subject' => true,
        'higher_promotion' => true,
        'higher_promotion_class_id' => true,
        'dues_paid' => true,
        'concession' => true,
        'working_day_last_class' => true,
        'present_day_last_class' => true,
        'ncc_cadet' => true,
        'general_conduct' => true,
        'other_remark' => true,
        'result_status' => true,
        'last_studied_class_id' => true,
        'extra_curricular_activity' => true,
        'extra_curricular_activity_name' => true,
        'achievement' => true,
        'student' => true,
        'student_class' => true,
        'session_year' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
    ];
}
