<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ExamMaxMark Entity
 *
 * @property int $id
 * @property int $exam_master_id
 * @property int $subject_id
 * @property float $max_marks
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property string $is_deleted
 *
 * @property \App\Model\Entity\ExamMaster $exam_master
 * @property \App\Model\Entity\Subject $subject
 */
class ExamMaxMark extends Entity
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
        'subject_id' => true,
        'session_year_id' => true,
        'max_marks' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'is_deleted' => true,
        'exam_master' => true,
        'subject' => true,
        'session_year' => true
    ];
}
