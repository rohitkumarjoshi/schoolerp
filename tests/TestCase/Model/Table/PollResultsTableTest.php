<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PollResultsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PollResultsTable Test Case
 */
class PollResultsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PollResultsTable
     */
    public $PollResults;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.poll_results',
        'app.students',
        'app.employees',
        'app.polls',
        'app.poll_rows'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PollResults') ? [] : ['className' => PollResultsTable::class];
        $this->PollResults = TableRegistry::getTableLocator()->get('PollResults', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PollResults);

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
