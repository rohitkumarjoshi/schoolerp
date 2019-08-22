<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ItemsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ItemsController Test Case
 */
class ItemsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.items',
        'app.item_categories',
        'app.item_subcategories',
        'app.grn_rows',
        'app.item_challan_rows',
        'app.item_issue_returns',
        'app.purchase_order_rows',
        'app.purchase_return_rows',
        'app.stock_ledgers'
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
