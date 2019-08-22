<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StudentSiblingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StudentSiblingsTable Test Case
 */
class StudentSiblingsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StudentSiblingsTable
     */
    public $StudentSiblings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.student_siblings',
        'app.students',
        'app.siblings',
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
        $config = TableRegistry::getTableLocator()->exists('StudentSiblings') ? [] : ['className' => StudentSiblingsTable::class];
        $this->StudentSiblings = TableRegistry::getTableLocator()->get('StudentSiblings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentSiblings);

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
