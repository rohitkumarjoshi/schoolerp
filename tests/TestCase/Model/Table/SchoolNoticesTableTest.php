<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SchoolNoticesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SchoolNoticesTable Test Case
 */
class SchoolNoticesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SchoolNoticesTable
     */
    public $SchoolNotices;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.school_notices'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SchoolNotices') ? [] : ['className' => SchoolNoticesTable::class];
        $this->SchoolNotices = TableRegistry::getTableLocator()->get('SchoolNotices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SchoolNotices);

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
