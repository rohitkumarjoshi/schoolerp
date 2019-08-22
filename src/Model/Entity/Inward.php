<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Inward Entity
 *
 * @property int $id
 * @property string $item_description
 * @property string $party_name
 * @property string $party_address
 * @property int $department_id
 * @property string $in_time
 * @property string $in_date
 * @property string $out_time
 * @property string $out_date
 * @property string $bill_no
 * @property string $person_name
 * @property string $mobile_no
 * @property string $remarks
 * @property \Cake\I18n\FrozenTime $created_on
 * @property string $inward_status
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property string $is_deleted
 *
 * @property \App\Model\Entity\Department $department
 * @property \App\Model\Entity\InwardDetail[] $inward_details
 */
class Inward extends Entity
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
        'item_description' => true,
        'party_name' => true,
        'party_address' => true,
        'department_id' => true,
        'in_time' => true,
        'in_date' => true,
        'out_time' => true,
        'out_date' => true,
        'bill_no' => true,
        'person_name' => true,
        'mobile_no' => true,
        'remarks' => true,
        'created_on' => true,
        'inward_status' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'is_deleted' => true,
        'department' => true,
        'inward_details' => true
    ];
}
