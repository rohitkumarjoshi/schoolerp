<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AssignmentStudent Entity
 *
 * @property int $id
 * @property int $assignment_id
 * @property int $student_info_id
 *
 * @property \App\Model\Entity\Assignment $assignment
 * @property \App\Model\Entity\StudentInfo $student_info
 */
class AssignmentStudent extends Entity
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
        '*' => true,
        'student_info_id' => true,
        'assignment' => true,
        'student' => true
    ];
}
