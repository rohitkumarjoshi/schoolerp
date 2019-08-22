<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClassTestStudentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClassTestStudentsTable Test Case
 */
class ClassTestStudentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ClassTestStudentsTable
     */
    public $ClassTestStudents;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.class_test_students',
        'app.class_tests',
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
        $config = TableRegistry::getTableLocator()->exists('ClassTestStudents') ? [] : ['className' => ClassTestStudentsTable::class];
        $this->ClassTestStudents = TableRegistry::getTableLocator()->get('ClassTestStudents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ClassTestStudents);

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
