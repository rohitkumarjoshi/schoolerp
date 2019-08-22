<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TotalMeeting Entity
 *
 * @property int $id
 * @property int $medium_id
 * @property int $student_class_id
 * @property int $stream_id
 * @property int $session_year_id
 * @property int $fee_month_id
 * @property float $total_meeting
 * @property int $created_by
 * @property int $edited_by
 *
 * @property \App\Model\Entity\Media $media
 * @property \App\Model\Entity\StudentClass $student_class
 * @property \App\Model\Entity\Stream $stream
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\FeeMonth $fee_month
 */
class TotalMeeting extends Entity
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
        'medium_id' => true,
        'student_class_id' => true,
        'stream_id' => true,
        'session_year_id' => true,
        'fee_month_id' => true,
        'total_meeting' => true,
        'created_by' => true,
        'edited_by' => true,
        'media' => true,
        'student_class' => true,
        'stream' => true,
        'session_year' => true,
        'fee_month' => true
    ];
}
