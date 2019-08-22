<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HostelRoomAssetsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HostelRoomAssetsTable Test Case
 */
class HostelRoomAssetsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HostelRoomAssetsTable
     */
    public $HostelRoomAssets;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.hostel_room_assets',
        'app.hostel_student_assets'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('HostelRoomAssets') ? [] : ['className' => HostelRoomAssetsTable::class];
        $this->HostelRoomAssets = TableRegistry::getTableLocator()->get('HostelRoomAssets', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HostelRoomAssets);

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
