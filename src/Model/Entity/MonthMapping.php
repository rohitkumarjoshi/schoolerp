<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MonthMapping Entity
 *
 * @property int $id
 * @property int $session_year_id
 * @property int $student_class_id
 * @property int $medium_id
 * @property int $stream_id
 * @property string $april
 * @property string $may
 * @property string $june
 * @property string $july
 * @property string $august
 * @property string $september
 * @property string $october
 * @property string $november
 * @property string $december
 * @property string $january
 * @property string $february
 * @property string $march
 *
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\StudentClass $student_class
 * @property \App\Model\Entity\Media $media
 * @property \App\Model\Entity\Stream $stream
 */
class MonthMapping extends Entity
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
        'student_class_id' => true,
        'medium_id' => true,
        'stream_id' => true,
        'april' => true,
        'may' => true,
        'june' => true,
        'july' => true,
        'august' => true,
        'september' => true,
        'october' => true,
        'november' => true,
        'december' => true,
        'january' => true,
        'february' => true,
        'march' => true,
        'session_year' => true,
        'student_class' => true,
        'media' => true,
        'stream' => true
    ];
}
