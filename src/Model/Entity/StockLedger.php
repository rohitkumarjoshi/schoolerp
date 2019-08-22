<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StockLedger Entity
 *
 * @property int $id
 * @property int $session_year_id
 * @property int $item_id
 * @property int $location_id
 * @property float $quantity
 * @property \Cake\I18n\FrozenDate $transaction_date
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 *
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\Item $item
 * @property \App\Model\Entity\Department $department
 * @property \App\Model\Entity\Source $source
 * @property \App\Model\Entity\SourceRow $source_row
 */
class StockLedger extends Entity
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
        'session_year_id' => true,
        'grn_id' => true,
        'grn_row_id' => true,
        'purchase_return_id' => true,
        'purchase_return_row_id' => true,
        'item_issue_return_id' => true,
        'item_issue_return_row_id' => true,
        '*' => true
        
    ];
}
