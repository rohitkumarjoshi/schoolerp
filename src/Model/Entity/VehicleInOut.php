<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VehicleInOut Entity
 *
 * @property int $id
 * @property string $vehicle_no
 * @property int $vehicle_id
 * @property \Cake\I18n\FrozenDate $in_date
 * @property \Cake\I18n\FrozenTime $in_time
 * @property \Cake\I18n\FrozenDate $out_date
 * @property \Cake\I18n\FrozenTime $out_time
 * @property string $remarks
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property string $is_deleted
 *
 * @property \App\Model\Entity\Vehicle $vehicle
 */
class VehicleInOut extends Entity
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
        'vehicle_no' => true,
        'vehicle_id' => true,
        'in_date' => true,
        'in_time' => true,
        'out_date' => true,
        'out_time' => true,
        'remarks' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'is_deleted' => true,
        'vehicle' => true
    ];
}
