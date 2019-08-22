<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemSubcategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemSubcategoriesTable Test Case
 */
class ItemSubcategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemSubcategoriesTable
     */
    public $ItemSubcategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.item_subcategories',
        'app.item_categories',
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
        $config = TableRegistry::getTableLocator()->exists('ItemSubcategories') ? [] : ['className' => ItemSubcategoriesTable::class];
        $this->ItemSubcategories = TableRegistry::getTableLocator()->get('ItemSubcategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemSubcategories);

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
