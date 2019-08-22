<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PurchaseReturn Entity
 *
 * @property int $id
 * @property int $vendor_id
 * @property int $session_year_id
 * @property \Cake\I18n\FrozenDate $transaction_date
 * @property int $voucher_no
 * @property string $remark
 * @property float $grand_total
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 *
 * @property \App\Model\Entity\PurchaseOrder $purchase_order
 * @property \App\Model\Entity\Grn $grn
 * @property \App\Model\Entity\Vendor $vendor
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\PurchaseReturnRow[] $purchase_return_rows
 */
class PurchaseReturn extends Entity
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
        'vendor_id' => true,
        'session_year_id' => true,
        'transaction_date' => true,
        'voucher_no' => true,
        'remark' => true,
        'grand_total' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'purchase_order' => true,
        'grn' => true,
        'vendor' => true,
        'session_year' => true,
        'purchase_return_rows' => true
    ];
}
