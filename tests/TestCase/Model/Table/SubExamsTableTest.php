<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SubExamsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SubExamsTable Test Case
 */
class SubExamsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SubExamsTable
     */
    public $SubExams;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sub_exams',
        'app.exam_masters',
        'app.student_marks'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SubExams') ? [] : ['className' => SubExamsTable::class];
        $this->SubExams = TableRegistry::getTableLocator()->get('SubExams', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SubExams);

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
