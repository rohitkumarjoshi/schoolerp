<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VehicleFeedback Entity
 *
 * @property int $id
 * @property int $student_id
 * @property int $vehicle_id
 * @property int $driver_id
 * @property \Cake\I18n\FrozenDate $date
 * @property string $comment
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 *
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\Vehicle $vehicle
 * @property \App\Model\Entity\Driver $driver
 */
class VehicleFeedback extends Entity
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
        'driver_id' => true,
        'date' => true,
        'comment' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'student' => true,
        'vehicle' => true,
        'driver' => true,
        'is_deleted'=>true
    ];
}
