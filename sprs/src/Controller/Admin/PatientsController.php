<?php

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Patients Controller
 *
 * @property \App\Model\Table\PatientsTable $Patients
 *
 * @method \App\Model\Entity\Patient[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PatientsController extends AppController {

    public function initialize() {
        parent::initialize();
        //$this->Auth->allow(['login']);
        $this->viewBuilder()->layout('Admin.default');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Doctors']
        ];
        $patients = $this->paginate($this->Patients);

        $this->set(compact('patients'));
    }

    /**
     * View method
     *
     * @param string|null $id Patient id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $patient = $this->Patients->get($id, [
            'contain' => ['Doctors']
        ]);

        $this->set('patient', $patient);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $patient = $this->Patients->newEntity();
        if ($this->request->is('post')) {
            $requestData = $this->request->data();
            $patient = $this->Patients->patchEntity($patient, $this->request->data());
            $patient->dob = \App\Controller\CommonController::convertToGMT(date("Y-m-d", strtotime($requestData["dob"])));
            $patientsave = $this->Patients->save($patient);
            if ($patientsave) {

                $patient_id = $patientsave->id;
                if (isset($requestData["profile_pic_upload"]) && $requestData["profile_pic_upload"] != '') {
                    $profile_pic = \App\Controller\CommonController::uploadImages($requestData["profile_pic_upload"], $patient_id, \Cake\Core\Configure::read("PATIENT_PROFILE_PATH"));
                    if ($profile_pic["status"]) {
                        $patient->profile_pic = $profile_pic["url"];
                        $this->Patients->save($patient);
                    }
                }
                $this->Flash->success(__('The patient has been saved.'), ["key" => "positive"]);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The patient could not be saved. Please, try again.'), ["key" => "negative"]);
        }
        $doctors = $this->Patients->Doctors->find('list', ['limit' => 200]);
        $this->set(compact('patient', 'doctors'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Patient id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $patient = $this->Patients->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $requestData = $this->request->data();
            
           
                unset($requestData['password']);
            $patient = $this->Patients->patchEntity($patient, $requestData);
            
            $patient->dob = \App\Controller\CommonController::convertToGMT(date("Y-m-d", strtotime($requestData["dob"])));
            if ($this->Patients->save($patient)) {
                if (isset($requestData["profile_pic_upload"]) && $requestData["profile_pic_upload"] != '') {
                    $profile_pic = \App\Controller\CommonController::uploadImages($requestData["profile_pic_upload"], $id, \Cake\Core\Configure::read("PATIENT_PROFILE_PATH"));
                    if ($profile_pic["status"]) {
                        $patient->profile_pic = $profile_pic["url"];
                        $this->Patients->save($patient);
                    }
                }
                $this->Flash->success(__('The patient has been saved.'), ["key" => "positive"]);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The patient could not be saved. Please, try again.'), ["key" => "negative"]);
        }
        $doctors = $this->Patients->Doctors->find('list', ['limit' => 200]);
        $this->set(compact('patient', 'doctors'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Patient id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {

        $patient = $this->Patients->get($id);
        $patient->is_delete = 1;
        if ($this->Patients->save($patient)) {
            $this->Flash->success(__('The patient has been deleted.'), ["key" => "positive"]);
        } else {
            $this->Flash->error(__('The patient could not be deleted. Please, try again.'), ["key" => "negative"]);
        }

        return $this->redirect(['action' => 'index']);
    }

}
