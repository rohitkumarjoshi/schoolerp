<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Appointment Entity
 *
 * @property int $id
 * @property int $student_id
 * @property int $employee_id
 * @property int $appointment_master_id
 * @property \Cake\I18n\FrozenDate $appointment_date
 * @property \Cake\I18n\FrozenTime $appointment_time
 * @property string $mobile_no
 * @property string $reason
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property string $is_deleted
 *
 * @property \App\Model\Entity\StudentInfo $student_info
 * @property \App\Model\Entity\Employee $employee
 * @property \App\Model\Entity\AppointmentMaster $appointment_master
 */
class Appointment extends Entity
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
        'employee_id' => true,
        'appointment_master_id' => true,
        'session_year_id' => true,
        'appointment_date' => true,
        'appointment_time' => true,
        'mobile_no' => true,
        'reason' => true,
        'status' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'is_deleted' => true,
        'student_info' => true,
        'employee' => true,
        'action_date' => true,
        'appointment_master' => true
    ];
}
