<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VehicleStudentAttendance Entity
 *
 * @property int $id
 * @property int $student_id
 * @property int $vehicle_id
 * @property \Cake\I18n\FrozenTime $in_time
 * @property \Cake\I18n\FrozenTime $out_time
 * @property int $taken_by
 * @property \Cake\I18n\FrozenDate $date
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 *
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\Vehicle $vehicle
 */
class VehicleStudentAttendance extends Entity
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
        'vehicle_id' => true,
        'in_time' => true,
        'out_time' => true,
        'taken_by' => true,
        'date' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'student' => true,
        'vehicle' => true,
        'is_deleted'=>true
    ];
}
