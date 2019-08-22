<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HealthMastersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HealthMastersTable Test Case
 */
class HealthMastersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HealthMastersTable
     */
    public $HealthMasters;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.health_masters',
        'app.student_healths'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('HealthMasters') ? [] : ['className' => HealthMastersTable::class];
        $this->HealthMasters = TableRegistry::getTableLocator()->get('HealthMasters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HealthMasters);

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
