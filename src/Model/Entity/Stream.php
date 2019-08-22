<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Stream Entity
 *
 * @property int $id
 * @property string $name
 * @property string $session_year_id
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property string $is_deleted
 *
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\ClassMapping[] $class_mappings
 * @property \App\Model\Entity\FeeTypeRow[] $fee_type_rows
 * @property \App\Model\Entity\MonthMapping[] $month_mappings
 * @property \App\Model\Entity\StudentInfo[] $student_infos
 */
class Stream extends Entity
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
        'name' => true,
        'session_year_id' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'is_deleted' => true,
        'session_year' => true,
        'class_mappings' => true,
        'fee_type_rows' => true,
        'month_mappings' => true,
        'student_infos' => true
    ];
}
