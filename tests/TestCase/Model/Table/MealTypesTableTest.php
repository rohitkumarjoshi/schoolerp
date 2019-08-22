<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MealTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MealTypesTable Test Case
 */
class MealTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MealTypesTable
     */
    public $MealTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.meal_types',
        'app.mess_attendances'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MealTypes') ? [] : ['className' => MealTypesTable::class];
        $this->MealTypes = TableRegistry::getTableLocator()->get('MealTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MealTypes);

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
