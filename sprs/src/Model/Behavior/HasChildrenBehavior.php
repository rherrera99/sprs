<?php

namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\Event\Event;
use Cake\ORM\Entity;

/**
 * HasChildren behavior
 */
class HasChildrenBehavior extends Behavior {

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function beforeDelete(Event $event, Entity $entity) {
        $associations = $this->_table->associations();
        foreach ($associations as $key => $value) {

            if (is_a($value, "Cake\ORM\Association\HasMany") && !$value->Dependent()) {
                $className = $value->ClassName();
                if ($className == null) {
                    $className = $value->Name();
                }
                $table = \Cake\ORM\TableRegistry::get($className);
                $checkKey = $value->ForeignKey();
                $childRecords = $table->find()->where(array($checkKey => $entity->id))->count();
                if ($childRecords > 0) {                    
                    return false;
                }
            }
        }

//        //Checking habtm relation as well, thanks to Zoltan 
//        if (isset($this->model->hasAndBelongsToMany)) {
//            foreach ($this->model->hasAndBelongsToMany as $key => $value) {
//                $childRecords = $this->model->{$key}->find('count', array('conditions' => array($value['foreignKey'] => $this->model->id)));
//                if ($childRecords > 0) {
//                    return false;
//                }
//            }
//        }
        return true;
    }

}
