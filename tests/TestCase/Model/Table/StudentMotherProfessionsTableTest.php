<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StudentMotherProfessionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StudentMotherProfessionsTable Test Case
 */
class StudentMotherProfessionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StudentMotherProfessionsTable
     */
    public $StudentMotherProfessions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.student_mother_professions',
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
        $config = TableRegistry::getTableLocator()->exists('StudentMotherProfessions') ? [] : ['className' => StudentMotherProfessionsTable::class];
        $this->StudentMotherProfessions = TableRegistry::getTableLocator()->get('StudentMotherProfessions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentMotherProfessions);

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
