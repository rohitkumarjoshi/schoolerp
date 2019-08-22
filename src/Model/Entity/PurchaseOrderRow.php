<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PurchaseOrderRow Entity
 *
 * @property int $id
 * @property int $purchase_order_id
 * @property int $item_id
 * @property float $rate
 * @property float $quantity
 * @property float $amount
 *
 * @property \App\Model\Entity\PurchaseOrder $purchase_order
 * @property \App\Model\Entity\Item $item
 * @property \App\Model\Entity\GrnRow[] $grn_rows
 */
class PurchaseOrderRow extends Entity
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
        'purchase_order_id' => true,
        'item_id' => true,
        'rate' => true,
        'quantity' => true,
        'amount' => true,
        'purchase_order' => true,
        'item' => true,
        'is_deleted' => true,
        'good_receive_note_rows' => true
        
    ];
}
