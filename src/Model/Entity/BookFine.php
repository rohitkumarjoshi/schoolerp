<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BookFine Entity
 *
 * @property int $id
 * @property int $fine_after_days
 * @property float $fine_amount_per_day
 * @property string $fine_for
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 */
class BookFine extends Entity
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
        'fine_after_days' => true,
        'fine_amount_per_day' => true,
        'fine_for' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true
    ];
}
