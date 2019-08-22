<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StudentDocumentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StudentDocumentsTable Test Case
 */
class StudentDocumentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StudentDocumentsTable
     */
    public $StudentDocuments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.student_documents',
        'app.session_years',
        'app.students',
        'app.enquiry_form_students',
        'app.document_class_mappings'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('StudentDocuments') ? [] : ['className' => StudentDocumentsTable::class];
        $this->StudentDocuments = TableRegistry::getTableLocator()->get('StudentDocuments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentDocuments);

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
