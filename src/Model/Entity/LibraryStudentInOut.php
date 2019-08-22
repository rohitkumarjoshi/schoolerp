<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LibraryStudentInOut Entity
 *
 * @property int $id
 * @property int $student_id
 * @property int $session_year_id
 * @property \Cake\I18n\FrozenDate $in_date
 * @property \Cake\I18n\FrozenTime $in_time
 * @property \Cake\I18n\FrozenDate $out_date
 * @property \Cake\I18n\FrozenTime $out_time
 * @property string $status
 *
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\SessionYear $session_year
 */
class LibraryStudentInOut extends Entity
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
        'student_id' => true,
        'session_year_id' => true,
        'in_date' => true,
        'in_time' => true,
        'out_date' => true,
        'out_time' => true,
        'status' => true,
        'student' => true,
        'session_year' => true
    ];
}
