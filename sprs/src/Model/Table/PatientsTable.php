<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Patients Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Doctors
 * @property \Cake\ORM\Association\HasMany $Draddpatients
 *
 * @method \App\Model\Entity\Patient get($primaryKey, $options = [])
 * @method \App\Model\Entity\Patient newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Patient[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Patient|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Patient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Patient[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Patient findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PatientsTable extends AppTable
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

        $this->table('patients');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Doctors', [
            'foreignKey' => 'doctor_id'
        ]);
        $this->hasMany('Draddpatients', [
            'foreignKey' => 'patient_id',
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');

        $validator
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        $validator
            ->dateTime('dob')
            ->requirePresence('dob', 'create')
            ->notEmpty('dob');

        $validator
            ->allowEmpty('address');

        $validator
            ->allowEmpty('about');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->allowEmpty('username');

        $validator
            ->allowEmpty('password');

        $validator
            ->allowEmpty('contact_no');

        $validator
            ->integer('gender')
            ->requirePresence('gender', 'create')
            ->notEmpty('gender');

        $validator
            ->allowEmpty('app_token');

        $validator
            ->allowEmpty('profile_pic');

        $validator
            ->decimal('height')
            ->allowEmpty('height');

        $validator
            ->decimal('weight')
            ->allowEmpty('weight');

        $validator
            ->dateTime('last_login')
            ->requirePresence('last_login', 'create')
            ->notEmpty('last_login');

        $validator
            ->integer('status')
            ->allowEmpty('status');

        $validator
            ->integer('is_delete')
            ->allowEmpty('is_delete');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->existsIn(['doctor_id'], 'Doctors'));

        return $rules;
    }
    
        public function authenticatePatient($username, $password) {

        $hasher = new DefaultPasswordHasher();
        $query = $this->find()
                ->select(['id', 'email', 'password', 'profile_pic', 'first_name', 'last_name','status','dob','is_delete'])
                ->where([
                    'email' => $username,
                ])
                ->first();

        if (!empty($query)) {
            $check_password = $hasher->check($password, $query->password);
            if ($check_password) {
                return $query;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
         public function authenticatePatientPassword($user_id, $password) {

        $hasher = new DefaultPasswordHasher();
        $query = $this->find()
                ->select(['id', 'email', 'password', 'profile_pic', 'first_name', 'last_name','status','dob','is_delete'])
                ->where([
                    'id' => $user_id,
                ])
                ->first();

        if (!empty($query)) {
            $check_password = $hasher->check($password, $query->password);
            if ($check_password) {
                return $query;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
