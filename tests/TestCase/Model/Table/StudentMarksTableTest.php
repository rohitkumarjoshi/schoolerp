<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StudentMarksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StudentMarksTable Test Case
 */
class StudentMarksTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StudentMarksTable
     */
    public $StudentMarks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.student_marks',
        'app.session_years',
        'app.student_infos',
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
        $config = TableRegistry::getTableLocator()->exists('StudentMarks') ? [] : ['className' => StudentMarksTable::class];
        $this->StudentMarks = TableRegistry::getTableLocator()->get('StudentMarks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentMarks);

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
