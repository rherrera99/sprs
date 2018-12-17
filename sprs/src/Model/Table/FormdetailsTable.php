<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Formdetails Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Forms
 * @property \Cake\ORM\Association\HasMany $Formoptions
 * @property \Cake\ORM\Association\HasMany $Ptreadingdetails
 *
 * @method \App\Model\Entity\Formdetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\Formdetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Formdetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Formdetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Formdetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Formdetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Formdetail findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */class FormdetailsTable extends AppTable
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

        $this->table('formdetails');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Forms', [
            'foreignKey' => 'form_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Formoptions', [
            'foreignKey' => 'formdetail_id',
            'dependent'=>true
        ]);
        $this->hasMany('Ptreadingdetails', [
            'foreignKey' => 'formdetail_id',
            'dependent'=>true
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
        $validator
            ->requirePresence('field_type', 'create')            ->notEmpty('field_type');
        $validator
            ->integer('is_dashboard')            ->requirePresence('is_dashboard', 'create')            ->notEmpty('is_dashboard');
        $validator
            ->integer('is_table')            ->requirePresence('is_table', 'create')            ->notEmpty('is_table');
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
        $rules->add($rules->existsIn(['form_id'], 'Forms'));

        return $rules;
    }
}
