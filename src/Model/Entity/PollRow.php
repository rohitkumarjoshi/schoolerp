<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PollRow Entity
 *
 * @property int $id
 * @property int $poll_id
 * @property int $objective
 * @property string $correct_answer
 *
 * @property \App\Model\Entity\Poll $poll
 * @property \App\Model\Entity\PollResult[] $poll_results
 */
class PollRow extends Entity
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
        'poll_id' => true,
        'objective' => true,
        'correct_answer' => true,
        'poll' => true,
        'poll_results' => true
    ];
}
