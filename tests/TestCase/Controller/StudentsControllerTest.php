<?php
namespace App\Test\TestCase\Controller;

use App\Controller\StudentsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\StudentsController Test Case
 */
class StudentsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.students',
        'app.genders',
        'app.session_years',
        'app.admission_classes',
        'app.admission_media',
        'app.admission_streams',
        'app.disabilities',
        'app.last_classes',
        'app.last_streams',
        'app.last_media',
        'app.book_issue_returns',
        'app.fee_receipts',
        'app.fee_type_student_masters',
        'app.hostel_attendances',
        'app.hostel_out_passes',
        'app.hostel_registrations',
        'app.hostel_student_assets',
        'app.item_issue_returns',
        'app.library_student_in_outs',
        'app.mess_attendances',
        'app.student_achivements',
        'app.student_documents',
        'app.student_infos',
        'app.student_red_diaries',
        'app.student_siblings',
        'app.vehicle_feedbacks',
        'app.vehicle_student_attendances'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
