<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EnquiryFormStudentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EnquiryFormStudentsTable Test Case
 */
class EnquiryFormStudentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EnquiryFormStudentsTable
     */
    public $EnquiryFormStudents;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.enquiry_form_students',
        'app.genders',
        'app.student_classes',
        'app.mediums',
        'app.streams',
        'app.session_years',
        'app.last_mediums',
        'app.last_classes',
        'app.last_streams',
        'app.fee_receipts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('EnquiryFormStudents') ? [] : ['className' => EnquiryFormStudentsTable::class];
        $this->EnquiryFormStudents = TableRegistry::getTableLocator()->get('EnquiryFormStudents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EnquiryFormStudents);

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
