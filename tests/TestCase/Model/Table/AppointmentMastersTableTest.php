<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AppointmentMastersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AppointmentMastersTable Test Case
 */
class AppointmentMastersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AppointmentMastersTable
     */
    public $AppointmentMasters;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.appointment_masters',
        'app.employees',
        'app.appointments'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('AppointmentMasters') ? [] : ['className' => AppointmentMastersTable::class];
        $this->AppointmentMasters = TableRegistry::getTableLocator()->get('AppointmentMasters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AppointmentMasters);

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
