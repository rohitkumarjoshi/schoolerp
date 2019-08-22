<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EntranceExamsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EntranceExamsTable Test Case
 */
class EntranceExamsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EntranceExamsTable
     */
    public $EntranceExams;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.entrance_exams',
        'app.session_years',
        'app.entrance_exam_results'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('EntranceExams') ? [] : ['className' => EntranceExamsTable::class];
        $this->EntranceExams = TableRegistry::getTableLocator()->get('EntranceExams', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EntranceExams);

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
