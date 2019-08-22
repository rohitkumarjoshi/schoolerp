<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VehicleStation Entity
 *
 * @property int $id
 * @property string $name
 * @property string $latitude
 * @property string $longitude
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 *
 * @property \App\Model\Entity\FeeTypeMaster[] $fee_type_masters
 * @property \App\Model\Entity\VehicleRoute[] $vehicle_routes
 */
class VehicleStation extends Entity
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
        'name' => true,
        'latitude' => true,
        'longitude' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'fee_type_masters' => true,
        'vehicle_routes' => true,
        'is_deleted'=>true
    ];
}
