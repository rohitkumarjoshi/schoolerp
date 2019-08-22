<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Result Entity
 *
 * @property int $id
 * @property int $student_info_id
 * @property int $exam_master_id
 * @property int $total
 * @property float $obtain
 * @property string $status
 * @property string $division
 * @property string $grade
 * @property float $percentage
 * @property string $supplementary
 * @property string $fail
 *
 * @property \App\Model\Entity\StudentInfo $student_info
 * @property \App\Model\Entity\ExamMaster $exam_master
 * @property \App\Model\Entity\ResultRow[] $result_rows
 */
class Result extends Entity
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
        'student_info_id' => true,
        'exam_master_id' => true,
        'total' => true,
        'obtain' => true,
        'status' => true,
        'division' => true,
        'grade' => true,
        'percentage' => true,
        'supplementary' => true,
        'fail' => true,
        'student_info' => true,
        'exam_master' => true,
        'result_rows' => true
    ];
}
