<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Notification Entity
 *
 * @property int $id
 * @property string $title
 * @property string $message
 * @property \Cake\I18n\FrozenDate $notify_date
 * @property string $notify_time
 * @property string $df_link
 * @property int $status
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $created_on
 *
 * @property \App\Model\Entity\NotificationRow[] $notification_rows
 */
class Notification extends Entity
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
        'message' => true,
        'notify_date' => true,
        'notify_time' => true,
        'df_link' => true,
        'status' => true,
        'created_by' => true,
        'created_on' => true,
        'notification_rows' => true
    ];
}
