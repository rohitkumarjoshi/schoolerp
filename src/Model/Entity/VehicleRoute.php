<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VehicleRoute Entity
 *
 * @property int $id
 * @property int $vehicle_id
 * @property int $vehicle_station_id
 * @property \Cake\I18n\FrozenTime $pickup_time
 * @property \Cake\I18n\FrozenTime $drop_time
 * @property int $station_order_by
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 *
 * @property \App\Model\Entity\Vehicle $vehicle
 * @property \App\Model\Entity\VehicleStation $vehicle_station
 */
class VehicleRoute extends Entity
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
        'vehicle_station_id' => true,
        'pickup_time' => true,
        'drop_time' => true,
        'station_order_by' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'vehicle' => true,
        'vehicle_station' => true,
        'is_deleted'=>true
    ];
}
