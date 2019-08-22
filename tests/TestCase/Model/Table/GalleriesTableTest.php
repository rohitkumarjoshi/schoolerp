<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GalleriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GalleriesTable Test Case
 */
class GalleriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GalleriesTable
     */
    public $Galleries;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.galleries',
        'app.event_shedules',
        'app.gallery_rows'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Galleries') ? [] : ['className' => GalleriesTable::class];
        $this->Galleries = TableRegistry::getTableLocator()->get('Galleries', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Galleries);

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
