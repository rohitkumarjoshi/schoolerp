<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LibraryStudentInOutsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LibraryStudentInOutsTable Test Case
 */
class LibraryStudentInOutsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LibraryStudentInOutsTable
     */
    public $LibraryStudentInOuts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.library_student_in_outs',
        'app.students',
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
        $config = TableRegistry::getTableLocator()->exists('LibraryStudentInOuts') ? [] : ['className' => LibraryStudentInOutsTable::class];
        $this->LibraryStudentInOuts = TableRegistry::getTableLocator()->get('LibraryStudentInOuts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LibraryStudentInOuts);

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
