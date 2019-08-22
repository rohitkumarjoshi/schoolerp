<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BookFinesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BookFinesTable Test Case
 */
class BookFinesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BookFinesTable
     */
    public $BookFines;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.book_fines'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('BookFines') ? [] : ['className' => BookFinesTable::class];
        $this->BookFines = TableRegistry::getTableLocator()->get('BookFines', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BookFines);

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
