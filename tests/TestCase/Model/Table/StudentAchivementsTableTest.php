<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StudentAchivementsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StudentAchivementsTable Test Case
 */
class StudentAchivementsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StudentAchivementsTable
     */
    public $StudentAchivements;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.student_achivements',
        'app.session_years',
        'app.achivement_categories',
        'app.students'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('StudentAchivements') ? [] : ['className' => StudentAchivementsTable::class];
        $this->StudentAchivements = TableRegistry::getTableLocator()->get('StudentAchivements', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentAchivements);

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
