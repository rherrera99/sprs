<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FormdetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FormdetailsTable Test Case
 */
class FormdetailsTableTest extends TestCase
{

    /**
     * Test subject     *
     * @var \App\Model\Table\FormdetailsTable     */
    public $Formdetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.formdetails',
        'app.forms',
        'app.formoptions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Formdetails') ? [] : ['className' => 'App\Model\Table\FormdetailsTable'];        $this->Formdetails = TableRegistry::get('Formdetails', $config);    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Formdetails);

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
