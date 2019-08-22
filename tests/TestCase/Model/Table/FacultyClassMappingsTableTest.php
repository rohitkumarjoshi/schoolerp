<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FacultyClassMappingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FacultyClassMappingsTable Test Case
 */
class FacultyClassMappingsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FacultyClassMappingsTable
     */
    public $FacultyClassMappings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.faculty_class_mappings',
        'app.class_mappings',
        'app.employees',
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
        $config = TableRegistry::getTableLocator()->exists('FacultyClassMappings') ? [] : ['className' => FacultyClassMappingsTable::class];
        $this->FacultyClassMappings = TableRegistry::getTableLocator()->get('FacultyClassMappings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FacultyClassMappings);

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
