<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EntranceExamResultsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EntranceExamResultsTable Test Case
 */
class EntranceExamResultsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EntranceExamResultsTable
     */
    public $EntranceExamResults;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.entrance_exam_results',
        'app.entrance_exams',
        'app.enquiry_form_students',
        'app.session_years'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('EntranceExamResults') ? [] : ['className' => EntranceExamResultsTable::class];
        $this->EntranceExamResults = TableRegistry::getTableLocator()->get('EntranceExamResults', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EntranceExamResults);

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
