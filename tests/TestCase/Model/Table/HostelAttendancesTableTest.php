<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HostelAttendancesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HostelAttendancesTable Test Case
 */
class HostelAttendancesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HostelAttendancesTable
     */
    public $HostelAttendances;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.hostel_attendances',
        'app.session_years',
        'app.students',
        'app.hostel_registrations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('HostelAttendances') ? [] : ['className' => HostelAttendancesTable::class];
        $this->HostelAttendances = TableRegistry::getTableLocator()->get('HostelAttendances', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HostelAttendances);

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
