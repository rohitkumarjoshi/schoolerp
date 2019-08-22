<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EntranceExamResult Entity
 *
 * @property int $id
 * @property int $entrance_exam_id
 * @property int $enquiry_form_student_id
 * @property string $obt_marks
 * @property int $session_year_id
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 *
 * @property \App\Model\Entity\EntranceExam $entrance_exam
 * @property \App\Model\Entity\EnquiryFormStudent $enquiry_form_student
 * @property \App\Model\Entity\SessionYear $session_year
 */
class EntranceExamResult extends Entity
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
        'entrance_exam_id' => true,
        'enquiry_form_student_id' => true,
        'obt_marks' => true,
        'session_year_id' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'entrance_exam' => true,
        'enquiry_form_student' => true,
        'session_year' => true
    ];
}
