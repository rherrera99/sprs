<?php
use Migrations\AbstractMigration;

class DoctorAddPatient extends AbstractMigration
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
         $table=$this->table("drAddpatients")
                ->addColumn("doctor_id", 'integer', [
                        'default' => null,
                        'limit' => 10,
                        'null' => true,
                    ])
                ->addColumn("patient_id",'integer', [
                        'default' => null,
                        'limit' => 10,
                        'null' => true,
                    ])
                ->create();
    }
}
