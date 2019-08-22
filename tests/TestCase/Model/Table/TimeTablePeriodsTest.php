<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TimeTablePeriods;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TimeTablePeriods Test Case
 */
class TimeTablePeriodsTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TimeTablePeriods
     */
    public $TimeTablePeriods;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TimePeriods') ? [] : ['className' => TimeTablePeriods::class];
        $this->TimeTablePeriods = TableRegistry::getTableLocator()->get('TimePeriods', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TimeTablePeriods);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
