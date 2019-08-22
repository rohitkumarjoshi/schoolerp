<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StudentParentProfessionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StudentParentProfessionsTable Test Case
 */
class StudentParentProfessionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StudentParentProfessionsTable
     */
    public $StudentParentProfessions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.student_parent_professions',
        'app.student_infos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('StudentParentProfessions') ? [] : ['className' => StudentParentProfessionsTable::class];
        $this->StudentParentProfessions = TableRegistry::getTableLocator()->get('StudentParentProfessions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentParentProfessions);

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
