<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StudentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StudentsTable Test Case
 */
class StudentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StudentsTable
     */
    public $Students;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.students',
        'app.genders',
        'app.session_years',
        'app.admission_classes',
        'app.admission_media',
        'app.admission_streams',
        'app.disabilities',
        'app.last_classes',
        'app.last_streams',
        'app.last_media',
        'app.book_issue_returns',
        'app.fee_receipts',
        'app.fee_type_student_masters',
        'app.hostel_attendances',
        'app.hostel_out_passes',
        'app.hostel_registrations',
        'app.hostel_student_assets',
        'app.item_issue_returns',
        'app.library_student_in_outs',
        'app.mess_attendances',
        'app.student_achivements',
        'app.student_documents',
        'app.student_infos',
        'app.student_red_diaries',
        'app.student_siblings',
        'app.vehicle_feedbacks',
        'app.vehicle_student_attendances'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Students') ? [] : ['className' => StudentsTable::class];
        $this->Students = TableRegistry::getTableLocator()->get('Students', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Students);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
