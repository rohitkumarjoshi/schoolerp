<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ResultRow Entity
 *
 * @property int $id
 * @property int $result_id
 * @property int $subject_id
 * @property int $exam_master_id
 * @property int $total
 * @property float $obtain
 * @property string $grade
 * @property float $grace
 *
 * @property \App\Model\Entity\Result $result
 * @property \App\Model\Entity\Subject $subject
 * @property \App\Model\Entity\ExamMaster $exam_master
 */
class ResultRow extends Entity
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
        'result_id' => true,
        'subject_id' => true,
        'exam_master_id' => true,
        'total' => true,
        'obtain' => true,
        'grade' => true,
        'grace' => true,
        'result' => true,
        'subject' => true,
        'exam_master' => true
    ];
}
