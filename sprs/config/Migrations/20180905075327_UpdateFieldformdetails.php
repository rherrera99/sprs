<?php
use Migrations\AbstractMigration;

class UpdateFieldformdetails extends AbstractMigration
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
         
                $table = $this->table("formdetails");

        $table->changeColumn("is_dashboard", "string", ["limit" => 10, 'default' => 0])
                ->changeColumn("is_table", "string", ["limit" => 10, 'default' => 0])
                ->update();

    }
}
