<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemIndentRowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemIndentRowsTable Test Case
 */
class ItemIndentRowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemIndentRowsTable
     */
    public $ItemIndentRows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.item_indent_rows',
        'app.items',
        'app.item_indents'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ItemIndentRows') ? [] : ['className' => ItemIndentRowsTable::class];
        $this->ItemIndentRows = TableRegistry::getTableLocator()->get('ItemIndentRows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemIndentRows);

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
