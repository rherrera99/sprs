<?php
use Migrations\AbstractMigration;

class AddPatientsfields extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
         $this->table('patients')
                ->changeColumn('height', 'decimal', ['precision' => 12, 'scale' => 2, "null" => true])
                ->changeColumn("weight", "decimal", ['precision' => 12, 'scale' => 2, "null" => true])
                 ->addColumn('status', 'integer', [
                    'default' => '1',
                    'limit' => 4,
                    'null' => true,
                ])
                ->update();
    }
    
}
