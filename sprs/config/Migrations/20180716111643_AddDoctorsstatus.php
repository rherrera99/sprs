<?php
use Migrations\AbstractMigration;

class AddDoctorsstatus extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {   $table = $this->table("doctors");
        $table->addColumn('status', 'integer', [
                    'default' => '1',
                    'limit' => 4,
                    'null' => true,
                ])
                ->update();
    }
}
