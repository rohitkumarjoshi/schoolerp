<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Grn Entity
 *
 * @property int $id
 * @property int $grn_no
 * @property int $vendor_id
 * @property int $session_year_id
 * @property int $purchase_order_id
 * @property \Cake\I18n\FrozenDate $transaction_date
 * @property float $grand_total
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 *
 * @property \App\Model\Entity\Vendor $vendor
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\PurchaseOrder $purchase_order
 * @property \App\Model\Entity\GrnRow[] $grn_rows
 * @property \App\Model\Entity\PurchaseReturn[] $purchase_returns
 */
class Grn extends Entity
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
        '*' => true,
        
    ];
}
