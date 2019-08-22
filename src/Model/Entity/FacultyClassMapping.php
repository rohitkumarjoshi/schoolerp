<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FacultyClassMapping Entity
 *
 * @property int $id
 * @property int $class_mapping_id
 * @property int $employee_id
 * @property int $subject_id
 * @property int $session_year_id
 * @property string $is_class_teacher
 *
 * @property \App\Model\Entity\ClassMapping $class_mapping
 * @property \App\Model\Entity\Employee $employee
 * @property \App\Model\Entity\SessionYear $session_year
 */
class FacultyClassMapping extends Entity
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
        'class_mapping_id' => true,
        'employee_id' => true,
        'subject_id' => true,
        'session_year_id' => true,
        'is_class_teacher' => true,
        'class_mapping' => true,
        'employee' => true,
        'session_year' => true
    ];
}
