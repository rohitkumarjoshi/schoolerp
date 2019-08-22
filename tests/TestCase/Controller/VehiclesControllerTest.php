<?php
namespace App\Test\TestCase\Controller;

use App\Controller\VehiclesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\VehiclesController Test Case
 */
class VehiclesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.vehicles',
        'app.expenses',
        'app.student_infos',
        'app.vehicle_driver_mappings',
        'app.vehicle_feedbacks',
        'app.vehicle_fuel_entries',
        'app.vehicle_routes',
        'app.vehicle_services',
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
