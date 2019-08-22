<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VehicleDriverMapping Entity
 *
 * @property int $id
 * @property int $vehicle_id
 * @property int $driver_id
 * @property int $conductor_id
 * @property \Cake\I18n\FrozenDate $assign_date
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property string $is_deleted
 *
 * @property \App\Model\Entity\Vehicle $vehicle
 * @property \App\Model\Entity\Driver $driver
 * @property \App\Model\Entity\Conductor $conductor
 */
class VehicleDriverMapping extends Entity
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
        'vehicle_id' => true,
        'driver_id' => true,
        'conductor_id' => true,
        'assign_date' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'is_deleted' => true,
        'vehicle' => true,
        'driver' => true,
        'conductor' => true
    ];
}
