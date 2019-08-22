<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Visitor Entity
 *
 * @property int $id
 * @property string $name
 * @property string $mobile_no
 * @property string $address
 * @property \Cake\I18n\FrozenDate $in_date
 * @property \Cake\I18n\FrozenTime $in_time
 * @property \Cake\I18n\FrozenDate $out_date
 * @property \Cake\I18n\FrozenTime $out_time
 * @property string $vehicle_no
 * @property int $city_id
 * @property int $employee_id
 * @property int $student_id
 * @property int $department_id
 * @property string $reason
 * @property string $remarks
 * @property string $id_card
 * @property string $id_card_no
 * @property string $photo
 * @property string $visitor_type
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property string $is_deleted
 *
 * @property \App\Model\Entity\City $city
 */
class Visitor extends Entity
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
        'mobile_no' => true,
        'address' => true,
        'in_date' => true,
        'in_time' => true,
        'out_date' => true,
        'out_time' => true,
        'vehicle_no' => true,
        'city_id' => true,
        'employee_id' => true,
        'student_id' => true,
        'reason' => true,
        'remarks' => true,
        'id_card' => true,
        'id_card_no' => true,
        'photo' => true,
        'visitor_type' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'is_deleted' => true,
        'city' => true
    ];
}
