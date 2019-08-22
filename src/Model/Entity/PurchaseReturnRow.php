<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PurchaseReturnRow Entity
 *
 * @property int $id
 * @property int $purchase_return_id
 * @property int $location_id
 * @property int $item_id
 * @property float $rate
 * @property float $quantity
 * @property float $amount
 *
 * @property \App\Model\Entity\PurchaseReturn $purchase_return
 * @property \App\Model\Entity\Item $item
 */
class PurchaseReturnRow extends Entity
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
        'purchase_return_id' => true,
        'location_id' => true,
        'item_id' => true,
        'rate' => true,
        'quantity' => true,
        'amount' => true,
        'purchase_return' => true,
        'item' => true
    ];
}
