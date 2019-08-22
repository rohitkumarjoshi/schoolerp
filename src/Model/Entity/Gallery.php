<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Gallery Entity
 *
 * @property int $id
 * @property string $title
 * @property string $role_type
 * @property string $cover_image
 * @property string $gallery_type
 * @property string $function_type
 * @property \Cake\I18n\FrozenDate $date_from
 * @property \Cake\I18n\FrozenDate $date_to
 * @property string $event_location
 * @property \Cake\I18n\FrozenTime $time_start
 * @property string $description
 * @property int $shareable
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property string $is_deleted
 *
 * @property \App\Model\Entity\EventShedule[] $event_shedules
 * @property \App\Model\Entity\GalleryRow[] $gallery_rows
 */
class Gallery extends Entity
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
        'title' => true,
        'role_type' => true,
        'cover_image' => true,
        'gallery_type' => true,
        'function_type' => true,
        'date_from' => true,
        'date_to' => true,
        'event_location' => true,
        'time_start' => true,
        'description' => true,
        'shareable' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'is_deleted' => true,
        'event_schedules' => true,
        'gallery_rows' => true
    ];
}
