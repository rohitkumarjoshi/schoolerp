<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ExamMaster Entity
 *
 * @property int $id
 * @property int $session_year_id
 * @property string $name
 * @property int $student_class_id
 * @property int $stream_id
 * @property int $parent_id
 * @property int $lft
 * @property int $rght
 * @property int $order_number
 * @property int $max_marks
 * @property int $number_of_best
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property string $is_deleted
 *
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\StudentClass $student_class
 * @property \App\Model\Entity\Stream $stream
 * @property \App\Model\Entity\ExamMaster $parent_exam_master
 * @property \App\Model\Entity\ExamMaster[] $child_exam_masters
 * @property \App\Model\Entity\StudentMark[] $student_marks
 * @property \App\Model\Entity\Subject[] $exams_subject
 */
class ExamMaster extends Entity
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
        'name' => true,
        'student_class_id' => true,
        'stream_id' => true,
        'parent_id' => true,
        'lft' => true,
        'rght' => true,
        'order_number' => true,
        'max_marks' => true,
        'number_of_best' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'is_deleted' => true,
        'session_year' => true,
        'student_class' => true,
        'stream' => true,
        'parent_exam_master' => true,
        'child_exam_masters' => true,
        'student_marks' => true,
        'sub_exams' => true,
        'exams_subject' => true
    ];
}
