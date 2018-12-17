<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Doctors Model
 *
 * @property \Cake\ORM\Association\HasMany $Draddpatients
 * @property \Cake\ORM\Association\HasMany $Patients
 *
 * @method \App\Model\Entity\Doctor get($primaryKey, $options = [])
 * @method \App\Model\Entity\Doctor newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Doctor[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Doctor|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Doctor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Doctor[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Doctor findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DoctorsTable extends AppTable
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

        $this->table('doctors');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Draddpatients', [
            'foreignKey' => 'doctor_id'
        ]);
        $this->hasMany('Patients', [
            'foreignKey' => 'doctor_id'
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
            ->allowEmpty('gender');

        $validator
            ->allowEmpty('app_token');

        $validator
            ->requirePresence('designation', 'create')
            ->notEmpty('designation');

        $validator
            ->allowEmpty('address');

        $validator
            ->allowEmpty('about');

        $validator
            ->allowEmpty('education');

        $validator
            ->allowEmpty('profile_pic');

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

        return $rules;
    }
         public function authenticateDoctor($username, $password) {

        $hasher = new DefaultPasswordHasher();
        $query = $this->find()
                ->select(['id', 'email', 'password', 'profile_pic', 'first_name', 'last_name','status','designation','is_delete'])
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
    
         public function authenticateDoctorpassword($user_id, $password) {

        $hasher = new DefaultPasswordHasher();
        $query = $this->find()
                ->select(['id', 'email', 'password', 'profile_pic', 'first_name', 'last_name','status','designation','is_delete'])
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
