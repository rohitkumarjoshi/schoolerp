<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SportRow Entity
 *
 * @property int $id
 * @property int $sport_id
 * @property string $file_path
 * @property string $is_deleted
 *
 * @property \App\Model\Entity\Sport $sport
 */
class SportRow extends Entity
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
        'sport_id' => true,
        'file_path' => true,
        'is_deleted' => true,
        'sport' => true
    ];
}
