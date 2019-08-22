<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BookCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BookCategoriesTable Test Case
 */
class BookCategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BookCategoriesTable
     */
    public $BookCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.book_categories',
        'app.books'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('BookCategories') ? [] : ['className' => BookCategoriesTable::class];
        $this->BookCategories = TableRegistry::getTableLocator()->get('BookCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BookCategories);

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
}
