<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Book Entity
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string $author_name
 * @property string $edition
 * @property string $volume
 * @property string $publisher
 * @property int $total_page
 * @property int $student_class_id
 * @property string $book_condition
 * @property int $book_category_id
 * @property int $subject_id
 * @property float $price
 * @property string $accession_no
 * @property string $is_reserved
 * @property string $is_deleted
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 *
 * @property \App\Model\Entity\StudentClass $student_class
 * @property \App\Model\Entity\BookCategory $book_category
 * @property \App\Model\Entity\Subject $subject
 * @property \App\Model\Entity\BookIssueReturn[] $book_issue_returns
 */
class Book extends Entity
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
        'name' => true,
        'title' => true,
        'author_name' => true,
        'edition' => true,
        'volume' => true,
        'publisher' => true,
        'total_page' => true,
        'medium_id' => true,
        'student_class_id' => true,
        'book_condition' => true,
        'book_category_id' => true,
        'subject_id' => true,
        'price' => true,
        'accession_no' => true,
        'is_reserved' => true,
        'is_deleted' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'medium' => true,
        'student_class' => true,
        'book_category' => true,
        'subject' => true,
        'book_issue_returns' => true
    ];
}
