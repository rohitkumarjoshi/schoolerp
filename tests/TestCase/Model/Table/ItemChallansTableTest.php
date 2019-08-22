<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemChallansTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemChallansTable Test Case
 */
class ItemChallansTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemChallansTable
     */
    public $ItemChallans;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.item_challans',
        'app.item_challan_rows'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ItemChallans') ? [] : ['className' => ItemChallansTable::class];
        $this->ItemChallans = TableRegistry::getTableLocator()->get('ItemChallans', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemChallans);

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
