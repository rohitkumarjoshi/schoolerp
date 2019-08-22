<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HostelRegistrationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HostelRegistrationsTable Test Case
 */
class HostelRegistrationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HostelRegistrationsTable
     */
    public $HostelRegistrations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.hostel_registrations',
        'app.session_years',
        'app.students',
        'app.hostels',
        'app.rooms'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('HostelRegistrations') ? [] : ['className' => HostelRegistrationsTable::class];
        $this->HostelRegistrations = TableRegistry::getTableLocator()->get('HostelRegistrations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HostelRegistrations);

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
