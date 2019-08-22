<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PurchaseReturnsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PurchaseReturnsTable Test Case
 */
class PurchaseReturnsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PurchaseReturnsTable
     */
    public $PurchaseReturns;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.purchase_returns',
        'app.purchase_orders',
        'app.grns',
        'app.vendors',
        'app.session_years',
        'app.purchase_return_rows'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PurchaseReturns') ? [] : ['className' => PurchaseReturnsTable::class];
        $this->PurchaseReturns = TableRegistry::getTableLocator()->get('PurchaseReturns', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PurchaseReturns);

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
