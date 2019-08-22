<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FeeTypeMastersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FeeTypeMastersTable Test Case
 */
class FeeTypeMastersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FeeTypeMastersTable
     */
    public $FeeTypeMasters;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.fee_type_masters',
        'app.session_years',
        'app.fee_categories',
        'app.fee_types',
        'app.vehicle_stations',
        'app.genders',
        'app.student_classes',
        'app.media',
        'app.streams',
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
        $config = TableRegistry::getTableLocator()->exists('FeeTypeMasters') ? [] : ['className' => FeeTypeMastersTable::class];
        $this->FeeTypeMasters = TableRegistry::getTableLocator()->get('FeeTypeMasters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FeeTypeMasters);

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
