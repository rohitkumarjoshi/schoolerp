<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SubjectTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SubjectTypesTable Test Case
 */
class SubjectTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SubjectTypesTable
     */
    public $SubjectTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.subject_types',
        'app.session_years',
        'app.subjects'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SubjectTypes') ? [] : ['className' => SubjectTypesTable::class];
        $this->SubjectTypes = TableRegistry::getTableLocator()->get('SubjectTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SubjectTypes);

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
