<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StudentMark Entity
 *
 * @property int $id
 * @property int $session_year_id
 * @property int $student_info_id
 * @property int $exam_master_id
 * @property int $sub_exam_id
 * @property int $subject_id
 * @property string $student_number
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property string $is_deleted
 *
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\StudentInfo $student_info
 * @property \App\Model\Entity\ExamMaster $exam_master
 * @property \App\Model\Entity\Subject $subject
 */
class StudentMark extends Entity
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
        'session_year_id' => true,
        'student_info_id' => true,
        'exam_master_id' => true,
        'sub_exam_id' => true,
        'subject_id' => true,
        'student_number' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'is_deleted' => true,
        'session_year' => true,
        'student_info' => true,
        'exam_master' => true,
        'subject' => true
    ];
}
