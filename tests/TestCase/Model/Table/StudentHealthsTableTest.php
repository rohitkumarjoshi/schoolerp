<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StudentHealthsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StudentHealthsTable Test Case
 */
class StudentHealthsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StudentHealthsTable
     */
    public $StudentHealths;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.student_healths',
        'app.session_years',
        'app.student_infos',
        'app.health_masters'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('StudentHealths') ? [] : ['className' => StudentHealthsTable::class];
        $this->StudentHealths = TableRegistry::getTableLocator()->get('StudentHealths', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentHealths);

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
