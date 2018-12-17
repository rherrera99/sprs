<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ptreadingdetails Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Ptreadings
 * @property \Cake\ORM\Association\BelongsTo $Formdetails
 *
 * @method \App\Model\Entity\Ptreadingdetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ptreadingdetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Ptreadingdetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ptreadingdetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ptreadingdetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ptreadingdetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ptreadingdetail findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */class PtreadingdetailsTable extends AppTable
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

        $this->table('ptreadingdetails');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Ptreadings', [
            'foreignKey' => 'ptreading_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Formdetails', [
            'foreignKey' => 'formdetail_id',
            'joinType' => 'INNER'
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
            ->requirePresence('formdetail_name', 'create')            ->notEmpty('formdetail_name');
        $validator
            ->requirePresence('reading_value', 'create')            ->notEmpty('reading_value');
        $validator
            ->requirePresence('reading_option', 'create')            ->notEmpty('reading_option');
        $validator
            ->requirePresence('is_dashboard', 'create')            ->notEmpty('is_dashboard');
        $validator
            ->requirePresence('is_table', 'create')            ->notEmpty('is_table');
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
        $rules->add($rules->existsIn(['ptreading_id'], 'Ptreadings'));
        $rules->add($rules->existsIn(['formdetail_id'], 'Formdetails'));

        return $rules;
    }
}
