<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OldFeesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OldFeesTable Test Case
 */
class OldFeesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\OldFeesTable
     */
    public $OldFees;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.old_fees',
        'app.session_years',
        'app.fee_categories',
        'app.fee_type_roles',
        'app.students',
        'app.fee_receipts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('OldFees') ? [] : ['className' => OldFeesTable::class];
        $this->OldFees = TableRegistry::getTableLocator()->get('OldFees', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OldFees);

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
