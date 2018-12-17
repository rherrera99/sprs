<?php
use Migrations\AbstractMigration;

class ChangeFieldFormdetail extends AbstractMigration
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

        $table->changeColumn("is_dashboard", "integer", ["limit" => 4, 'default' => 0])
                ->changeColumn("is_table", "integer", ["limit" => 4, 'default' => 0])
                ->update();
    }
}
