<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StudentInfosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StudentInfosTable Test Case
 */
class StudentInfosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StudentInfosTable
     */
    public $StudentInfos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.student_infos',
        'app.students',
        'app.fee_type_roles',
        'app.vehicle_stations',
        'app.reservation_categories',
        'app.states',
        'app.cities',
        'app.session_years',
        'app.castes',
        'app.religions',
        'app.student_classes',
        'app.mediums',
        'app.sections',
        'app.streams',
        'app.houses',
        'app.student_parent_professions',
        'app.vehicles',
        'app.hostels',
        'app.rooms',
        'app.fee_receipts',
        'app.student_healths',
        'app.student_marks'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('StudentInfos') ? [] : ['className' => StudentInfosTable::class];
        $this->StudentInfos = TableRegistry::getTableLocator()->get('StudentInfos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentInfos);

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
