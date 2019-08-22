<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GrnRowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GrnRowsTable Test Case
 */
class GrnRowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GrnRowsTable
     */
    public $GrnRows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.grn_rows',
        'app.grns',
        'app.items',
        'app.locations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('GrnRows') ? [] : ['className' => GrnRowsTable::class];
        $this->GrnRows = TableRegistry::getTableLocator()->get('GrnRows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GrnRows);

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
