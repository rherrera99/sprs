<?php

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Doctors Controller
 *
 * @property \App\Model\Table\DoctorsTable $Doctors
 */
class DoctorsController extends AppController {

    public function initialize() {
        parent::initialize();
        //$this->Auth->allow(['login']);
        $this->viewBuilder()->layout('Admin.default');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $doctors = $this->paginate($this->Doctors);

        $this->set(compact('doctors'));
        $this->set('_serialize', ['doctors']);
    }

    /**
     * View method
     *
     * @param string|null $id Doctor id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $doctor = $this->Doctors->get($id, [
            'contain' => []
        ]);

        $this->set('doctor', $doctor);
        $this->set('_serialize', ['doctor']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $doctor = $this->Doctors->newEntity();
        if ($this->request->is('post')) {
            $requestData = $this->request->data;
            $doctor = $this->Doctors->patchEntity($doctor, $this->request->data);

            $doctorsave = $this->Doctors->save($doctor);
            if ($doctorsave) {
                $doctor_id = $doctorsave->id;
                if (isset($requestData["profile_pic_upload"]) && $requestData["profile_pic_upload"] != '') {
                    $profile_pic = \App\Controller\CommonController::uploadImages($requestData["profile_pic_upload"], $doctor_id, \Cake\Core\Configure::read("DOCTOR_PROFILE_PATH"));
                    if ($profile_pic["status"]) {
                        $doctor->profile_pic = $profile_pic["url"];
                        $this->Doctors->save($doctor);
                    }
                }

                $this->Flash->success(__('The doctor has been saved.'), ["key" => "positive"]);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doctor could not be saved. Please, try again.'), ["key" => "negative"]);
        }
        $this->set(compact('doctor'));
        $this->set('_serialize', ['doctor']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Doctor id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $doctor = $this->Doctors->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $requestData = $this->request->data;
            if ($requestData['password'] == '' || $requestData['password'] == null)
                unset($requestData['password']);
            $doctor = $this->Doctors->patchEntity($doctor, $requestData );
            
            
            
            if ($this->Doctors->save($doctor)) {
                if (isset($requestData["profile_pic_upload"]) && $requestData["profile_pic_upload"] != '') {
                    $profile_pic = \App\Controller\CommonController::uploadImages($requestData["profile_pic_upload"], $id, \Cake\Core\Configure::read("DOCTOR_PROFILE_PATH"));
                    if ($profile_pic["status"]) {
                        $doctor->profile_pic = $profile_pic["url"];
                        $this->Doctors->save($doctor);
                    }
                }
                $this->Flash->success(__('The doctor has been saved.'), ["key" => "positive"]);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doctor could not be saved. Please, try again.'), ["key" => "negative"]);
        }
        $this->set(compact('doctor'));
        $this->set('_serialize', ['doctor']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Doctor id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {

        $doctor = $this->Doctors->get($id);
        $doctor->is_delete = 1;

        if ($this->Doctors->save($doctor)) {
            $this->Flash->success(__('The doctor has been deleted.'), ["key" => "positive"]);
        } else {
            $this->Flash->error(__('The doctor could not be deleted. Please, try again.'), ["key" => "negative"]);
        }

        return $this->redirect(['action' => 'index']);
    }

    public function uploadBase64Image($folder_url, $image_code, $doctor_id) {
        $data = base64_decode($image_code);
        $imageName = "doctor_profile_" . $doctor_id . "_" . time() . ".jpg";
        if (!is_dir($folder_url)) {
            mkdir($folder_url, 0777, true);
        }
        file_put_contents($folder_url . $imageName, $data);
        return $imageName;
    }

}
