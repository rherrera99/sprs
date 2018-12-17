<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AllocatedFormsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AllocatedFormsTable Test Case
 */
class AllocatedFormsTableTest extends TestCase
{

    /**
     * Test subject     *
     * @var \App\Model\Table\AllocatedFormsTable     */
    public $AllocatedForms;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.allocated_forms',
        'app.draddpatients',
        'app.doctors',
        'app.patients',
        'app.forms',
        'app.formdetails',
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
        $config = TableRegistry::exists('AllocatedForms') ? [] : ['className' => 'App\Model\Table\AllocatedFormsTable'];        $this->AllocatedForms = TableRegistry::get('AllocatedForms', $config);    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AllocatedForms);

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
