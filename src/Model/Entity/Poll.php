<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Poll Entity
 *
 * @property int $id
 * @property string $question
 * @property string $poll_type
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property string $is_deleted
 *
 * @property \App\Model\Entity\PollResult[] $poll_results
 * @property \App\Model\Entity\PollRow[] $poll_rows
 */
class Poll extends Entity
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
        'poll_type' => true,
        'created_on' => true,
        'created_by' => true,
        'is_deleted' => true,
        'poll_results' => true,
        'poll_rows' => true
    ];
}
