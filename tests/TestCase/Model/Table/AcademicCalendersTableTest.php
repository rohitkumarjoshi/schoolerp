<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AcademicCalendersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AcademicCalendersTable Test Case
 */
class AcademicCalendersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AcademicCalendersTable
     */
    public $AcademicCalenders;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.academic_calenders',
        'app.session_years',
        'app.academic_categories',
        'app.employees'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('AcademicCalenders') ? [] : ['className' => AcademicCalendersTable::class];
        $this->AcademicCalenders = TableRegistry::getTableLocator()->get('AcademicCalenders', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AcademicCalenders);

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
