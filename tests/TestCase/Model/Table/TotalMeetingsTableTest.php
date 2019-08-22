<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TotalMeetingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TotalMeetingsTable Test Case
 */
class TotalMeetingsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TotalMeetingsTable
     */
    public $TotalMeetings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.total_meetings',
        'app.media',
        'app.student_classes',
        'app.streams',
        'app.session_years',
        'app.fee_months'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TotalMeetings') ? [] : ['className' => TotalMeetingsTable::class];
        $this->TotalMeetings = TableRegistry::getTableLocator()->get('TotalMeetings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TotalMeetings);

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
