<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AttendancesFixture
 *
 */
class AttendancesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'session_year_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'medium_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'student_class_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'stream_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'section_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'student_info_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'first_half' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => '0', 'collate' => 'latin1_swedish_ci', 'comment' => '0 = A, 1 = L, 0.5 = H', 'precision' => null, 'fixed' => null],
        'second_half' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => '0', 'collate' => 'latin1_swedish_ci', 'comment' => '0 = A, 1 = L, 0.5 = H', 'precision' => null, 'fixed' => null],
        'attendance_date' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'created_on' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'created_by' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'edited_on' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'edited_by' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'is_deleted' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => 'N', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'session_year_id' => 1,
                'medium_id' => 1,
                'student_class_id' => 1,
                'stream_id' => 1,
                'section_id' => 1,
                'student_info_id' => 1,
                'first_half' => 'Lorem ipsum dolor sit amet',
                'second_half' => 'Lorem ipsum dolor sit amet',
                'attendance_date' => '2018-12-28',
                'created_on' => 1545987044,
                'created_by' => 1,
                'edited_on' => 1545987044,
                'edited_by' => 1,
                'is_deleted' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
