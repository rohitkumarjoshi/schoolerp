<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemIndentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemIndentsTable Test Case
 */
class ItemIndentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemIndentsTable
     */
    public $ItemIndents;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.item_indents',
        'app.employees',
        'app.item_indent_rows'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ItemIndents') ? [] : ['className' => ItemIndentsTable::class];
        $this->ItemIndents = TableRegistry::getTableLocator()->get('ItemIndents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemIndents);

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
