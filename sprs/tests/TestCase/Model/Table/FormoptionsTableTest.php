<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FormoptionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FormoptionsTable Test Case
 */
class FormoptionsTableTest extends TestCase
{

    /**
     * Test subject     *
     * @var \App\Model\Table\FormoptionsTable     */
    public $Formoptions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.formoptions',
        'app.formdetails',
        'app.forms'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Formoptions') ? [] : ['className' => 'App\Model\Table\FormoptionsTable'];        $this->Formoptions = TableRegistry::get('Formoptions', $config);    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Formoptions);

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
