<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * HostelAttendance Entity
 *
 * @property int $id
 * @property int $session_year_id
 * @property int $student_id
 * @property int $hostel_registration_id
 * @property \Cake\I18n\FrozenDate $date
 * @property \Cake\I18n\FrozenTime $time
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property string $is_deleted
 *
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\HostelRegistration $hostel_registration
 */
class HostelAttendance extends Entity
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
        'student_id' => true,
        'hostel_registration_id' => true,
        'date' => true,
        'time' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'is_deleted' => true,
        'session_year' => true,
        'student' => true,
        'hostel_registration' => true
    ];
}
