<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SessionYearsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SessionYearsTable Test Case
 */
class SessionYearsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SessionYearsTable
     */
    public $SessionYears;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.session_years',
        'app.book_issue_returns',
        'app.class_mappings',
        'app.enquiry_form_students',
        'app.fee_month_mappings',
        'app.fee_receipts',
        'app.fee_type_masters',
        'app.fee_type_receipts',
        'app.fee_type_student_masters',
        'app.grns',
        'app.hostel_attendances',
        'app.hostel_gate_passes',
        'app.hostel_registrations',
        'app.item_issue_returns',
        'app.library_student_in_outs',
        'app.mediums',
        'app.monthly_fees',
        'app.purchase_orders',
        'app.purchase_returns',
        'app.sections',
        'app.stock_ledgers',
        'app.streams',
        'app.student_achivements',
        'app.student_classes',
        'app.student_documents',
        'app.student_infos',
        'app.student_red_diaries',
        'app.student_siblings',
        'app.students',
        'app.vehicle_student_attendances'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SessionYears') ? [] : ['className' => SessionYearsTable::class];
        $this->SessionYears = TableRegistry::getTableLocator()->get('SessionYears', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SessionYears);

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
}
