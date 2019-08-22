<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExamMaxMarksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExamMaxMarksTable Test Case
 */
class ExamMaxMarksTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ExamMaxMarksTable
     */
    public $ExamMaxMarks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.exam_max_marks',
        'app.exam_masters',
        'app.subjects'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ExamMaxMarks') ? [] : ['className' => ExamMaxMarksTable::class];
        $this->ExamMaxMarks = TableRegistry::getTableLocator()->get('ExamMaxMarks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ExamMaxMarks);

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
