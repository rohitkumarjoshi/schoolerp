<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BookIssueReturnsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BookIssueReturnsTable Test Case
 */
class BookIssueReturnsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BookIssueReturnsTable
     */
    public $BookIssueReturns;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.book_issue_returns',
        'app.books',
        'app.students',
        'app.session_years',
        'app.employees'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('BookIssueReturns') ? [] : ['className' => BookIssueReturnsTable::class];
        $this->BookIssueReturns = TableRegistry::getTableLocator()->get('BookIssueReturns', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BookIssueReturns);

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
