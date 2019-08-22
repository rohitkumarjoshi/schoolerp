<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MonthMappingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MonthMappingsTable Test Case
 */
class MonthMappingsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MonthMappingsTable
     */
    public $MonthMappings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.month_mappings',
        'app.session_years',
        'app.student_classes',
        'app.media',
        'app.streams'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MonthMappings') ? [] : ['className' => MonthMappingsTable::class];
        $this->MonthMappings = TableRegistry::getTableLocator()->get('MonthMappings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MonthMappings);

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
