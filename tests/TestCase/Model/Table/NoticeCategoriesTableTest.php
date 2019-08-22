<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NoticeCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NoticeCategoriesTable Test Case
 */
class NoticeCategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NoticeCategoriesTable
     */
    public $NoticeCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.notice_categories',
        'app.notices'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('NoticeCategories') ? [] : ['className' => NoticeCategoriesTable::class];
        $this->NoticeCategories = TableRegistry::getTableLocator()->get('NoticeCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->NoticeCategories);

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
