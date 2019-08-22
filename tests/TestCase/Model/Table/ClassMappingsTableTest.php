<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClassMappingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClassMappingsTable Test Case
 */
class ClassMappingsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ClassMappingsTable
     */
    public $ClassMappings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.class_mappings',
        'app.mediums',
        'app.student_classes',
        'app.streams',
        'app.sections',
        'app.session_years',
        'app.faculty_class_mappings'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ClassMappings') ? [] : ['className' => ClassMappingsTable::class];
        $this->ClassMappings = TableRegistry::getTableLocator()->get('ClassMappings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ClassMappings);

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
