<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FeeMonthsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FeeMonthsTable Test Case
 */
class FeeMonthsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FeeMonthsTable
     */
    public $FeeMonths;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.fee_months',
        'app.fee_receipt_rows',
        'app.fee_type_master_rows'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('FeeMonths') ? [] : ['className' => FeeMonthsTable::class];
        $this->FeeMonths = TableRegistry::getTableLocator()->get('FeeMonths', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FeeMonths);

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
