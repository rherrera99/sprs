<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AllocatedForms Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Draddpatients
 * @property \Cake\ORM\Association\BelongsTo $Forms
 * @property \Cake\ORM\Association\HasMany $Ptreadings
 *
 * @method \App\Model\Entity\AllocatedForm get($primaryKey, $options = [])
 * @method \App\Model\Entity\AllocatedForm newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AllocatedForm[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AllocatedForm|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AllocatedForm patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AllocatedForm[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AllocatedForm findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */class AllocatedFormsTable extends AppTable
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

        $this->table('allocated_forms');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Draddpatients', [
            'foreignKey' => 'draddpatient_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Forms', [
            'foreignKey' => 'form_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Ptreadings', [
            'foreignKey' => 'allocated_form_id',
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
        $rules->add($rules->existsIn(['draddpatient_id'], 'Draddpatients'));
        $rules->add($rules->existsIn(['form_id'], 'Forms'));

        return $rules;
    }
}
