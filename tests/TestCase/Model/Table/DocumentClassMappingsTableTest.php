<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DocumentClassMappingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DocumentClassMappingsTable Test Case
 */
class DocumentClassMappingsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DocumentClassMappingsTable
     */
    public $DocumentClassMappings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.document_class_mappings',
        'app.session_years',
        'app.documents',
        'app.student_classes',
        'app.student_documents'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('DocumentClassMappings') ? [] : ['className' => DocumentClassMappingsTable::class];
        $this->DocumentClassMappings = TableRegistry::getTableLocator()->get('DocumentClassMappings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DocumentClassMappings);

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
