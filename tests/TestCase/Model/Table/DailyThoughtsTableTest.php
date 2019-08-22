<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DailyThoughtsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DailyThoughtsTable Test Case
 */
class DailyThoughtsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DailyThoughtsTable
     */
    public $DailyThoughts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.daily_thoughts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('DailyThoughts') ? [] : ['className' => DailyThoughtsTable::class];
        $this->DailyThoughts = TableRegistry::getTableLocator()->get('DailyThoughts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DailyThoughts);

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
