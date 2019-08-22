<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HostelsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HostelsTable Test Case
 */
class HostelsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HostelsTable
     */
    public $Hostels;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.hostels',
        'app.wardens',
        'app.assistant_wardens',
        'app.hostel_attendances',
        'app.hostel_registrations',
        'app.rooms',
        'app.student_infos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Hostels') ? [] : ['className' => HostelsTable::class];
        $this->Hostels = TableRegistry::getTableLocator()->get('Hostels', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Hostels);

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
