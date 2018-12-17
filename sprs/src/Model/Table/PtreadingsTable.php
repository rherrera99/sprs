<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ptreadings Model
 *
 * @property \Cake\ORM\Association\BelongsTo $AllocatedForms
 * @property \Cake\ORM\Association\HasMany $Ptreadingdetails
 *
 * @method \App\Model\Entity\Ptreading get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ptreading newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Ptreading[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ptreading|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ptreading patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ptreading[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ptreading findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */class PtreadingsTable extends AppTable
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('ptreadings');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('AllocatedForms', [
            'foreignKey' => 'allocated_form_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Ptreadingdetails', [
            'foreignKey' => 'ptreading_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')            ->allowEmpty('id', 'create');
        $validator
            ->requirePresence('field_name', 'create')            ->notEmpty('field_name');
        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['allocated_form_id'], 'AllocatedForms'));

        return $rules;
    }
}
