<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FeeType Entity
 *
 * @property int $id
 * @property int $fee_category_id
 * @property string $name
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 *
 * @property \App\Model\Entity\FeeCategory $fee_category
 * @property \App\Model\Entity\FeeTypeMaster[] $fee_type_masters
 */
class FeeType extends Entity
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
        'fee_category_id' => true,
        'session_year_id' => true,
        'name' => true,
        'fee_type_role_id' => true,
        'is_deleted' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'fee_category' => true,
        'fee_type_role' => true,
        'fee_type_masters' => true
    ];
}
