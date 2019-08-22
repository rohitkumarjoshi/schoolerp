<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StudentClassesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StudentClassesTable Test Case
 */
class StudentClassesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StudentClassesTable
     */
    public $StudentClasses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.student_classes',
        'app.session_years',
        'app.best_mark_subjects',
        'app.books',
        'app.class_mappings',
        'app.enquiry_form_students',
        'app.exam_masters',
        'app.fee_month_mappings',
        'app.fee_type_masters',
        'app.grade_masters',
        'app.student_infos',
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
        $config = TableRegistry::getTableLocator()->exists('StudentClasses') ? [] : ['className' => StudentClassesTable::class];
        $this->StudentClasses = TableRegistry::getTableLocator()->get('StudentClasses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentClasses);

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
