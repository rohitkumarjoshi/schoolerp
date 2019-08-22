<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemIssueReturnsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemIssueReturnsTable Test Case
 */
class ItemIssueReturnsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemIssueReturnsTable
     */
    public $ItemIssueReturns;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.item_issue_returns',
        'app.session_years',
        'app.students',
        'app.employees',
        'app.item_issue_return_rows'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ItemIssueReturns') ? [] : ['className' => ItemIssueReturnsTable::class];
        $this->ItemIssueReturns = TableRegistry::getTableLocator()->get('ItemIssueReturns', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemIssueReturns);

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
