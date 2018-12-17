<?php

use Migrations\AbstractMigration;

class AddLogintimeFields extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        
        $table = $this->table("doctors");

        $table->addColumn("last_login", "datetime", ["after" => "profile_pic"])                
                ->update();

        
        
        $table = $this->table("patients");
        $table->addColumn("last_login", "datetime", ["after" => "weight"])
                ->update();
    }

}
