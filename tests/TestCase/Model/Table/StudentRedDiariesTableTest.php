<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StudentRedDiariesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StudentRedDiariesTable Test Case
 */
class StudentRedDiariesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StudentRedDiariesTable
     */
    public $StudentRedDiaries;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.student_red_diaries',
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
        $config = TableRegistry::getTableLocator()->exists('StudentRedDiaries') ? [] : ['className' => StudentRedDiariesTable::class];
        $this->StudentRedDiaries = TableRegistry::getTableLocator()->get('StudentRedDiaries', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentRedDiaries);

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
