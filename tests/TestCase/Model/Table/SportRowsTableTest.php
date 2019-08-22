<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SportRowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SportRowsTable Test Case
 */
class SportRowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SportRowsTable
     */
    public $SportRows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sport_rows',
        'app.sports'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SportRows') ? [] : ['className' => SportRowsTable::class];
        $this->SportRows = TableRegistry::getTableLocator()->get('SportRows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SportRows);

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
