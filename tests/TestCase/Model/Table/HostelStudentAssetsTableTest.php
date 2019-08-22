<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HostelStudentAssetsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HostelStudentAssetsTable Test Case
 */
class HostelStudentAssetsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HostelStudentAssetsTable
     */
    public $HostelStudentAssets;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.hostel_student_assets',
        'app.students',
        'app.session_years',
        'app.hostel_room_assets'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('HostelStudentAssets') ? [] : ['className' => HostelStudentAssetsTable::class];
        $this->HostelStudentAssets = TableRegistry::getTableLocator()->get('HostelStudentAssets', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HostelStudentAssets);

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
