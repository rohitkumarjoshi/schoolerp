<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SubExam Entity
 *
 * @property int $id
 * @property int $exam_master_id
 * @property string $name
 * @property int $max_marks
 *
 * @property \App\Model\Entity\ExamMaster $exam_master
 * @property \App\Model\Entity\StudentMark[] $student_marks
 */
class SubExam extends Entity
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
        'exam_master_id' => true,
        'name' => true,
        'max_marks' => true,
        'exam_master' => true,
        'student_marks' => true
    ];
}
