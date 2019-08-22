<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PollRowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PollRowsTable Test Case
 */
class PollRowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PollRowsTable
     */
    public $PollRows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.poll_rows',
        'app.polls',
        'app.poll_results'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PollRows') ? [] : ['className' => PollRowsTable::class];
        $this->PollRows = TableRegistry::getTableLocator()->get('PollRows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PollRows);

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
