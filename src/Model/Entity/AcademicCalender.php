<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AcademicCalender Entity
 *
 * @property int $id
 * @property int $session_year_id
 * @property int $academic_category_id
 * @property \Cake\I18n\FrozenDate $date
 * @property string $description
 * @property int $employee_id
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property string $is_deleted
 *
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\AcademicCategory $academic_category
 * @property \App\Model\Entity\Employee $employee
 */
class AcademicCalender extends Entity
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
        'academic_category_id' => true,
        'date' => true,
        'description' => true,
        'employee_id' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'is_deleted' => true,
        'session_year' => true,
        'academic_category' => true,
        'employee' => true
    ];
}
