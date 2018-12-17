<?php
use Migrations\AbstractMigration;

class DeleteDoctorAndPatient extends AbstractMigration
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
        $table = $this->table("doctors");
        $table->addColumn('is_delete', 'integer', [
                    'default' => 0,
                    'limit' => 4,
                    'null' => true,
                ])
                ->update();
        $table = $this->table("patients");
        $table->addColumn('is_delete', 'integer', [
                    'default' => 0,
                    'limit' => 4,
                    'null' => true,
                ])
                ->update();
    
    }
}
