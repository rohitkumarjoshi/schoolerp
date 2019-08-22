<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemIssueReturnRowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemIssueReturnRowsTable Test Case
 */
class ItemIssueReturnRowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemIssueReturnRowsTable
     */
    public $ItemIssueReturnRows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.item_issue_return_rows',
        'app.item_issue_returns',
        'app.items'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ItemIssueReturnRows') ? [] : ['className' => ItemIssueReturnRowsTable::class];
        $this->ItemIssueReturnRows = TableRegistry::getTableLocator()->get('ItemIssueReturnRows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemIssueReturnRows);

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
