<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExamMastersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExamMastersTable Test Case
 */
class ExamMastersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ExamMastersTable
     */
    public $ExamMasters;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.exam_masters',
        'app.session_years',
        'app.student_classes',
        'app.streams',
        'app.student_marks',
        'app.exams_subject'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ExamMasters') ? [] : ['className' => ExamMastersTable::class];
        $this->ExamMasters = TableRegistry::getTableLocator()->get('ExamMasters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ExamMasters);

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
