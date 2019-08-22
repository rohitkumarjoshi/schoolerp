<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InwardDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InwardDetailsTable Test Case
 */
class InwardDetailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InwardDetailsTable
     */
    public $InwardDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.inward_details',
        'app.inwards'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('InwardDetails') ? [] : ['className' => InwardDetailsTable::class];
        $this->InwardDetails = TableRegistry::getTableLocator()->get('InwardDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->InwardDetails);

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
