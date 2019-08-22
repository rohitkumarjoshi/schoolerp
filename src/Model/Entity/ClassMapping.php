<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ClassMapping Entity
 *
 * @property int $id
 * @property int $medium_id
 * @property int $student_class_id
 * @property int $stream_id
 * @property int $section_id
 * @property int $employee_id
 * @property int $session_year_id
 * @property string $is_deleted
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 *
 * @property \App\Model\Entity\Medium $medium
 * @property \App\Model\Entity\StudentClass $student_class
 * @property \App\Model\Entity\Stream $stream
 * @property \App\Model\Entity\Section $section
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\FacultyClassMapping[] $faculty_class_mappings
 */
class ClassMapping extends Entity
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
        'medium_id' => true,
        'student_class_id' => true,
        'stream_id' => true,
        'section_id' => true,
        'employee_id' => true,
        'session_year_id' => true,
        'is_deleted' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'medium' => true,
        'student_class' => true,
        'stream' => true,
        'section' => true,
        'employee' => true,
        'session_year' => true,
        'faculty_class_mappings' => true
    ];
}
