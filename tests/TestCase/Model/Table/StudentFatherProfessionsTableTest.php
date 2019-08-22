<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StudentFatherProfessionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StudentFatherProfessionsTable Test Case
 */
class StudentFatherProfessionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StudentFatherProfessionsTable
     */
    public $StudentFatherProfessions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.student_father_professions',
        'app.session_years',
        'app.enquiry_form_students',
        'app.students',
        'app.student_parent_professions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('StudentFatherProfessions') ? [] : ['className' => StudentFatherProfessionsTable::class];
        $this->StudentFatherProfessions = TableRegistry::getTableLocator()->get('StudentFatherProfessions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentFatherProfessions);

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
