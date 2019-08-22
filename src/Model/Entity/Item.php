<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Item Entity
 *
 * @property int $id
 * @property int $item_category_id
 * @property int $item_subcategory_id
 * @property string $name
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property string $is_deleted
 *
 * @property \App\Model\Entity\ItemCategory $item_category
 * @property \App\Model\Entity\ItemSubcategory $item_subcategory
 * @property \App\Model\Entity\GrnRow[] $grn_rows
 * @property \App\Model\Entity\ItemIssueReturn[] $item_issue_returns
 * @property \App\Model\Entity\PurchaseOrderRow[] $purchase_order_rows
 * @property \App\Model\Entity\PurchaseReturnRow[] $purchase_return_rows
 * @property \App\Model\Entity\StockLedger[] $stock_ledgers
 */
class Item extends Entity
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
