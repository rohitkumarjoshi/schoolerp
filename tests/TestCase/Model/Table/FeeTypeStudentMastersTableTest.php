<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FeeTypeStudentMastersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FeeTypeStudentMastersTable Test Case
 */
class FeeTypeStudentMastersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FeeTypeStudentMastersTable
     */
    public $FeeTypeStudentMasters;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.fee_type_student_masters',
        'app.fee_type_master_rows',
        'app.student_infos',
        'app.session_years',
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
        $config = TableRegistry::getTableLocator()->exists('FeeTypeStudentMasters') ? [] : ['className' => FeeTypeStudentMastersTable::class];
        $this->FeeTypeStudentMasters = TableRegistry::getTableLocator()->get('FeeTypeStudentMasters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FeeTypeStudentMasters);

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
