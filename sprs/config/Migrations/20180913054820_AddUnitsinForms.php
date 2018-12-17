<?php

use Migrations\AbstractMigration;

class AddUnitsinForms extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table=$this->table("formdetails");
        $table->addColumn("is_required","integer",["limit"=>4,"default"=>0,"null"=>true,"after"=>"is_table"])
              ->addColumn("units","string",["limit"=>5000,"null"=>true,"after"=>"is_table"]);
        
        $table->update();
        $table=$this->table("ptreadingdetails");
        $table->addColumn("units","string",["limit"=>1000,"null"=>true,"after"=>"is_table"]);
        $table->update();
                
    }

}
