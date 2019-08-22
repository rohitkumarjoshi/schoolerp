<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FeeTypeMasterRowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FeeTypeMasterRowsTable Test Case
 */
class FeeTypeMasterRowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FeeTypeMasterRowsTable
     */
    public $FeeTypeMasterRows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.fee_type_master_rows',
        'app.fee_type_masters',
        'app.fee_months',
        'app.fee_receipt_rows',
        'app.fee_type_student_masters'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('FeeTypeMasterRows') ? [] : ['className' => FeeTypeMasterRowsTable::class];
        $this->FeeTypeMasterRows = TableRegistry::getTableLocator()->get('FeeTypeMasterRows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FeeTypeMasterRows);

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
