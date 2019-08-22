<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VehicleFuelEntry Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $fill_date
 * @property int $filled_by
 * @property int $vehicle_id
 * @property float $amount
 * @property int $previous_km
 * @property int $current_km
 * @property float $liter
 * @property float $milege
 * @property string $bill_no
 * @property string $remark
 * @property int $difference_km
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 *
 * @property \App\Model\Entity\Vehicle $vehicle
 */
class VehicleFuelEntry extends Entity
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
        'fill_date' => true,
        'filled_by' => true,
        'vehicle_id' => true,
        'amount' => true,
        'previous_km' => true,
        'current_km' => true,
        'liter' => true,
        'milege' => true,
        'bill_no' => true,
        'remark' => true,
        'difference_km' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'vehicle' => true,
        'is_deleted'=>true
    ];
}
