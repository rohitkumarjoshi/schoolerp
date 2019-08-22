<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BestMarkSubjectRow Entity
 *
 * @property int $id
 * @property int $best_mark_subject_id
 * @property int $exam_master_id
 *
 * @property \App\Model\Entity\BestMarkSubject $best_mark_subject
 * @property \App\Model\Entity\ExamMaster $exam_master
 */
class BestMarkSubjectRow extends Entity
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
        'best_mark_subject_id' => true,
        'exam_master_id' => true,
        'best_mark_subject' => true,
        'exam_master' => true
    ];
}
