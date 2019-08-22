<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ResultRowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ResultRowsTable Test Case
 */
class ResultRowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ResultRowsTable
     */
    public $ResultRows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.result_rows',
        'app.results',
        'app.subjects',
        'app.exam_masters'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ResultRows') ? [] : ['className' => ResultRowsTable::class];
        $this->ResultRows = TableRegistry::getTableLocator()->get('ResultRows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ResultRows);

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
