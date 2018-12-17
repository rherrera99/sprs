<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['password']);
        $this->viewBuilder()->layout('Admin.default');
    }

    /**
     * Login method
     *
     * @return \Cake\Network\Response|null
     */
    public function login() {
        $this->viewBuilder()->layout('Admin.login');  
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            $this->Restaurants = TableRegistry::get('Users');
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->loginError(__('Invalid username or password, try again'));
        }
    }

    public function logout() {
        if (isset($_COOKIE['currentTimezone']))
            unset($_COOKIE['currentTimezone']);

        $this->Flash->loginSuccess(__('You have been logged out successfully'));
        return $this->redirect($this->Auth->logout());
    }

    public function index() {

        $this->paginate = [
            'contain' => ['Cities']
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    public function add() {
//        $this->Countries = TableRegistry::get("Countries");
//        $this->States = TableRegistry::get("States");
//        $countries = $this->Countries->find('list')->hydrate(false)->toArray();
//        $states = [];
//        $cities = [];
//
//        $user = $this->Users->newEntity();
//        if ($this->request->is('post')) {
//            $requestData = $this->request->data;
//            if ($requestData["get_location"] == '1') {
//                if ($requestData["country_id"]) {
//                    $states = $this->States->find('list')->where(["States.country_id" => $requestData["country_id"], "States.status" => 1])->hydrate(false)->toArray();
//                }
//                if ($requestData["state_id"]) {
//                    $cities = $this->Users->Cities->find('list')->where(["Cities.state_id" => $requestData["state_id"], "Cities.status" => 1])->hydrate(false)->toArray();
//                }
//            } else {
//                $user = $this->Users->patchEntity($user, $requestData);
//                //debug($user);
//                if ($this->Users->save($user)) {
//                    $this->Flash->success(__('The user has been saved.'),['key' => 'positive']);
//                    return $this->redirect(['action' => 'index']);
//                } else {
//                    $this->Flash->error(__('The user could not be saved. Please, try again.'),['key' => 'negative']);
//                }
//            }
//        }
//        $this->set(compact('user', 'cities', 'states', 'countries'));
//        $this->set('_serialize', ['user']);
    }

    public function password() {
         $this->viewBuilder()->layout('Admin.login');
//        $user = $this->Users->get($this->Auth->user('id'), [
//            'contain' => []
//        ]);
//
//        if ($this->request->is(['patch', 'post', 'put'])) {
//            $user = $this->Users->patchEntity($user, $this->request->data);
//            if ($this->Users->save($user)) {
//                $this->Flash->success(__('The password has been saved.'), ['key' => 'positive']);
//
//                return $this->redirect(['action' => 'password']);
//            } else {
//                $this->Flash->error(__('The password could not be saved. Please, try again.'), ['key' => 'negative']);
//            }
//        }
//
//        $this->set(compact('user'));
//        $this->set('_serialize', ['user']);
    }
    
    public function passwordChanage() {
        // $this->viewBuilder()->layout('password_chanage');
        $user = $this->Users->get($this->Auth->user('id'), [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The password has been saved.'), ['key' => 'positive']);

                return $this->redirect(['action' => 'passwordChanage']);
            } else {
                $this->Flash->error(__('The password could not be saved. Please, try again.'), ['key' => 'negative']);
            }
        }

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    // /**
    //  * Index method
    //  *
    //  * @return \Cake\Network\Response|null
    //  */
    // public function index()
    // {
    //     $users = $this->paginate($this->Users);
    //     $this->set(compact('users'));
    //     $this->set('_serialize', ['users']);
    // }
    // /**
    //  * View method
    //  *
    //  * @param string|null $id User id.
    //  * @return \Cake\Network\Response|null
    //  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
    //  */
    public function view($id = null) {
        $this->viewBuilder()->layout('Admin.ajax');
        $user = $this->Users->get($id, [
            'contain' => ["Cities"]
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    // /**
    //  * Add method
    //  *
    //  * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
    //  */
    // public function add()
    // {
    //     $user = $this->Users->newEntity();
    //     if ($this->request->is('post')) {
    //         $user = $this->Users->patchEntity($user, $this->request->data);
    //         if ($this->Users->save($user)) {
    //             $this->Flash->success(__('The user has been saved.'));
    //             return $this->redirect(['action' => 'index']);
    //         } else {
    //             $this->Flash->error(__('The user could not be saved. Please, try again.'));
    //         }
    //     }
    //     $this->set(compact('user'));
    //     $this->set('_serialize', ['user']);
    // }
    // /**
    //  * Edit method
    //  *
    //  * @param string|null $id User id.
    //  * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
    //  * @throws \Cake\Network\Exception\NotFoundException When record not found.
    //  */
    public function edit($id = null) {
//        $this->Countries = TableRegistry::get("Countries");
//        $this->States = TableRegistry::get("States");
//        $user = $this->Users->get($id, [
//            'contain' => ['Cities']
//        ]);
//        if ($user->city_id) {
//
//            $selectedStateId = $user->city->state_id;
//            $countryRec = $this->States->find("all")->where(["States.id" => $selectedStateId])->hydrate(false)->toArray();
//            $selectedCountryId = $countryRec[0]['country_id'];
//            $countries = $this->Countries->find('list')->hydrate(false)->toArray();
//            $states = $this->States->find('list')->where(["States.country_id" => $selectedCountryId, "States.status" => 1])->hydrate(false)->toarray();
//            $cities = $this->Users->Cities->find('list')->where(["Cities.state_id" => $selectedStateId, "Cities.status" => 1])->hydrate(false)->toarray();
//        } else {
//            $selectedCountryId = "";
//            $selectedStateId = "";
//            $countries = $this->Countries->find('list')->hydrate(false)->toArray();
//            $states = [];
//            $cities = [];
//        }
//        if ($this->request->is(['patch', 'post', 'put'])) {
//            $requestData = $this->request->data;
//            if ($requestData["get_location"] == '1') {
//                if ($requestData["country_id"] != "") {
//                    $selectedCountryId = $requestData["country_id"];
//                    $selectedStateId = "";
//                    $states = $this->States->find('list')->where(["States.country_id" => $requestData["country_id"], "States.status" => 1])->hydrate(false)->toArray();
//                    $cities = [];
//                }
//                if ($requestData["state_id"] != "") {
//                    $selectedStateId = $requestData["state_id"];
//                    $cities = $this->Users->Cities->find('list')->where(["Cities.state_id" => $requestData["state_id"], "Cities.status" => 1])->hydrate(false)->toArray();
//                    //debug($cities);  
//                }
//            } else {
//                if ($requestData['password'] == '' || $requestData['password'] == null)
//                    unset($requestData['password']);
//                $user = $this->Users->patchEntity($user, $this->request->data);
//
//                if ($this->Users->save($user)) {
//                    $this->Flash->success(__('The user has been updated.'),['key' => 'positive']);
//
//                    return $this->redirect(['action' => 'index']);
//                }
//                $this->Flash->error(__('The customer could not be saved. Please, try again.'),['key' => 'negative']);
//            }
//        }
//
//        //$cities = $this->Users->Cities->find('list', ['limit' => 200]);
//        $this->set(compact('user', 'cities', 'states', 'countries', 'selectedStateId', 'selectedCountryId'));
//        $this->set('_serialize', ['customer']);
    }

    // /**
    //  * Delete method
    //  *
    //  * @param string|null $id User id.
    //  * @return \Cake\Network\Response|null Redirects to index.
    //  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
    //  */
    public function delete($id = null) {

        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'),['key' => 'positive']);
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'),['key' => 'negative']);
        }
        return $this->redirect(['action' => 'index']);
    }

    
    
    
}
