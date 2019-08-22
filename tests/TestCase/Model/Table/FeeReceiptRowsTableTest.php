<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FeeReceiptRowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FeeReceiptRowsTable Test Case
 */
class FeeReceiptRowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FeeReceiptRowsTable
     */
    public $FeeReceiptRows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.fee_receipt_rows',
        'app.fee_receipts',
        'app.fee_type_masters',
        'app.fee_type_master_rows',
        'app.fee_type_student_masters',
        'app.fee_months'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('FeeReceiptRows') ? [] : ['className' => FeeReceiptRowsTable::class];
        $this->FeeReceiptRows = TableRegistry::getTableLocator()->get('FeeReceiptRows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FeeReceiptRows);

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
