<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StudentElectiveSubject Entity
 *
 * @property int $id
 * @property int $student_info_id
 * @property int $subject_id
 * @property int $session_year_id
 *
 * @property \App\Model\Entity\StudentInfo $student_info
 * @property \App\Model\Entity\Subject $subject
 * @property \App\Model\Entity\SessionYear $session_year
 */
class StudentElectiveSubject extends Entity
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
        'subject_id' => true,
        'session_year_id' => true,
        'student_info' => true,
        'subject' => true,
        'session_year' => true
    ];
}
