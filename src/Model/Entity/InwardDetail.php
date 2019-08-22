<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * InwardDetail Entity
 *
 * @property int $id
 * @property int $inward_id
 * @property string $material
 * @property float $quantity
 *
 * @property \App\Model\Entity\Inward $inward
 */
class InwardDetail extends Entity
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
        'inward_id' => true,
        'material' => true,
        'quantity' => true,
        'inward' => true
    ];
}
