<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VehicleService Entity
 *
 * @property int $id
 * @property int $vehicle_id
 * @property int $driver_id
 * @property \Cake\I18n\FrozenDate $service_date
 * @property int $km
 * @property string $bill_no
 * @property float $amount
 * @property int $vendor_id
 * @property \Cake\I18n\FrozenDate $next_service
 * @property string $remark
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 *
 * @property \App\Model\Entity\Vehicle $vehicle
 * @property \App\Model\Entity\Vendor $vendor
 * @property \App\Model\Entity\Employee $driver
 */
class VehicleService extends Entity
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
        'service_date' => true,
        'km' => true,
        'bill_no' => true,
        'amount' => true,
        'vendor_id' => true,
        'next_service' => true,
        'remark' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'vehicle' => true,
        'vendor' => true,
        'driver' => true,
        'is_deleted' => true
    ];
}
