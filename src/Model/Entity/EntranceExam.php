<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EntranceExam Entity
 *
 * @property int $id
 * @property int $session_year_id
 * @property string $subject_name
 * @property string $minimum_marks
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property string $is_deleted
 *
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\EntranceExamResult[] $entrance_exam_results
 */
class EntranceExam extends Entity
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
        'subject_name' => true,
        'minimum_marks' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'is_deleted' => true,
        'session_year' => true,
        'entrance_exam_results' => true
    ];
}
