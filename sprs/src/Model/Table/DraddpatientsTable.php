<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Draddpatients Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Doctors
 * @property \Cake\ORM\Association\BelongsTo $Patients
 * @property \Cake\ORM\Association\HasMany $AllocatedForms
 *
 * @method \App\Model\Entity\Draddpatient get($primaryKey, $options = [])
 * @method \App\Model\Entity\Draddpatient newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Draddpatient[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Draddpatient|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Draddpatient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Draddpatient[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Draddpatient findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */class DraddpatientsTable extends AppTable
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

        $this->table('draddpatients');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Doctors', [
            'foreignKey' => 'doctor_id'
        ]);
        $this->belongsTo('Patients', [
            'foreignKey' => 'patient_id'
        ]);
        $this->hasMany('AllocatedForms', [
            'foreignKey' => 'draddpatient_id'
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
            ->allowEmpty('forms_list');
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
        $rules->add($rules->existsIn(['doctor_id'], 'Doctors'));
        $rules->add($rules->existsIn(['patient_id'], 'Patients'));

        return $rules;
    }
}
