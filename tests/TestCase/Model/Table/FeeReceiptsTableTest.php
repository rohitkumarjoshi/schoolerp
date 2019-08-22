<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FeeReceiptsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FeeReceiptsTable Test Case
 */
class FeeReceiptsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FeeReceiptsTable
     */
    public $FeeReceipts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.fee_receipts',
        'app.session_years',
        'app.fee_type_receipts',
        'app.students',
        'app.student_infos',
        'app.fee_receipt_rows'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('FeeReceipts') ? [] : ['className' => FeeReceiptsTable::class];
        $this->FeeReceipts = TableRegistry::getTableLocator()->get('FeeReceipts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FeeReceipts);

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
