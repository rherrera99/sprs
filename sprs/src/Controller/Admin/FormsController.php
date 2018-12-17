<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Utility\Hash;
use Cake\ORM\TableRegistry;

/**
 * Forms Controller
 *
 * @property \App\Model\Table\FormsTable $Forms */
class FormsController extends AppController {

    public function initialize() {
        parent::initialize();
        //$this->Auth->allow(['login']);
        $this->viewBuilder()->layout('Admin.default');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     * 
     */
    public function index() {
        $forms = $this->paginate($this->Forms);

        $this->set(compact('forms'));
        $this->set('_serialize', ['forms']);
    }

    /**
     * View method
     *
     * @param string|null $id Form id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $form = $this->Forms->get($id, [
            'contain' => ['Formdetails']
        ]);

        $this->set('form', $form);
        $this->set('_serialize', ['form']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {

//debug($this->request->data);exit;

        $form = $this->Forms->newEntity();
        $this->Formdetails = TableRegistry::get('Formdetails');
        $this->Formoptions = TableRegistry::get('Formoptions');
        if ($this->request->is('post')) {



            $form = $this->Forms->patchEntity($form, $this->request->data);

            $form_last_id = $this->Forms->save($form);

            $request_data = $this->request->data;

            $total_field = $request_data['total_field'];

            for ($i = 0; $i < $total_field; $i++) {

                if (isset($request_data["field_name_" . ($i + 1)]) && isset($request_data["field_type_" . ($i + 1)]) && $request_data["field_name_" . ($i + 1)] && $request_data["field_type_" . ($i + 1)]) {
                    $formdetail = $this->Formdetails->newEntity();
                    $formdetail->form_id = $form_last_id->id;
                    $formdetail->field_name = $request_data["field_name_" . ($i + 1)];
                    $formdetail->field_type = $request_data["field_type_" . ($i + 1)];

                    if (isset($request_data["is_dashboard_" . ($i + 1)]) && $request_data["is_dashboard_" . ($i + 1)] == 'on') {
                        $formdetail->is_dashboard = 1;
                    }
                    if (isset($request_data["is_table_" . ($i + 1)]) && $request_data["is_table_" . ($i + 1)] == 'on') {
                        $formdetail->is_table = 1;
                    }
                    if (isset($request_data["is_required_" . ($i + 1)]) && $request_data["is_required_" . ($i + 1)] == 'on') {
                        $formdetail->is_required = 1;
                    }
                    if (isset($request_data["units_" . ($i + 1)]) && $request_data["units_" . ($i + 1)] != '') {
                        $units_array = explode(",", trim($request_data["units_" . ($i + 1)]));
                        $final_units_array = array();
                        foreach ($units_array as $key => $value) {
                            if ($value != '') {
                                array_push($final_units_array, $value);
                            }
                        }
                        if ($final_units_array) {
                            $formdetail->units = json_encode($final_units_array);
                        }
                    }


                    $save_form_details = $this->Formdetails->save($formdetail);
                    // debug($formdetail);exit();
                    if (isset($request_data["no_of_options_" . ($i + 1)]) && $request_data["no_of_options_" . ($i + 1)]) {
                        for ($j = 0; $j < $request_data["no_of_options_" . ($i + 1)]; $j++) {
                            if (isset($request_data["form_option_" . ($i + 1) . "_" . ($j + 1)]) && $request_data["form_option_" . ($i + 1) . "_" . ($j + 1)]) {
                                $formoption = $this->Formoptions->newEntity();

                                $formoption->formdetail_id = $save_form_details->id;
                                $formoption->option_name = $request_data["form_option_" . ($i + 1) . "_" . ($j + 1)];
                                $save_formoption = $this->Formoptions->save($formoption);
                            }
                        }
                    }
                }
            }
            if ($form_last_id) {
                $this->Flash->success(__('The form has been saved.'), ["key" => "positive"]);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The form could not be saved. Please, try again.'), ["key" => "negative"]);
        }
        $this->set(compact('form'));
        $this->set('_serialize', ['form']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Form id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {

        // debug($this->request->data); exit();
        $this->Formdetails = TableRegistry::get('Formdetails');
        $this->Formoptions = TableRegistry::get('Formoptions');
        $form = $this->Forms->get($id, [
            'contain' => ["Formdetails", "Formdetails.Formoptions"]
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            // debug($this->request->data);
            //exit();

            $form = $this->Forms->patchEntity($form, $this->request->data);
            if ($this->Forms->save($form)) {

                $request_data = $this->request->data;

                //debug($request_data);exit();
                $total_field = $request_data['total_field'];

                for ($i = 0; $i < $total_field; $i++) {
                    // debug($request_data);
                    //exit();
                    if (isset($request_data["field_name_" . ($i + 1)]) && isset($request_data["field_type_" . ($i + 1)]) && $request_data["field_name_" . ($i + 1)] && $request_data["field_type_" . ($i + 1)]) {

                        if (isset($request_data["remove_field_id_" . ($i + 1)]) && $request_data["remove_field_id_" . ($i + 1)]) {

                            $formdetail = $this->Formdetails->get($request_data["remove_field_id_" . ($i + 1)]);
                        } else {
                            $formdetail = $this->Formdetails->newEntity();
                        }

                        $formdetail->form_id = $id;
                        $formdetail->field_name = $request_data["field_name_" . ($i + 1)];
                        $formdetail->field_type = $request_data["field_type_" . ($i + 1)];

                        if (isset($request_data["is_dashboard_" . ($i + 1)]) && $request_data["is_dashboard_" . ($i + 1)] == 'on') {
                            $formdetail->is_dashboard = 1;
                        } else {
                            $formdetail->is_dashboard = 0;
                        }

                        if (isset($request_data["is_table_" . ($i + 1)]) && $request_data["is_table_" . ($i + 1)] == 'on') {
                            $formdetail->is_table = 1;
                        } else {
                            $formdetail->is_table = 0;
                        }
                        if (isset($request_data["is_required_" . ($i + 1)]) && $request_data["is_required_" . ($i + 1)] == 'on') {
                            $formdetail->is_required = 1;
                        } else {
                            $formdetail->is_required = 0;
                        }
                        if (isset($request_data["units_" . ($i + 1)]) && $request_data["units_" . ($i + 1)] != '') {
                            $units_array = explode(",", trim($request_data["units_" . ($i + 1)]));
                            $final_units_array = array();
                            foreach ($units_array as $key => $value) {
                                if ($value != '') {
                                    array_push($final_units_array, $value);
                                }
                            }
                            if ($final_units_array) {
                                $formdetail->units = json_encode($final_units_array);
                            } else {
                                $formdetail->units = "";
                            }
                        } else {
                            $formdetail->units = "";
                        }



                        $save_form_details = $this->Formdetails->save($formdetail);
                        // debug($formdetail);exit();
                        if (isset($request_data["no_of_options_" . ($i + 1)]) && $request_data["no_of_options_" . ($i + 1)]) {
                            for ($j = 0; $j < $request_data["no_of_options_" . ($i + 1)]; $j++) {
                                if (isset($request_data["form_option_" . ($i + 1) . "_" . ($j + 1)]) && $request_data["form_option_" . ($i + 1) . "_" . ($j + 1)]) {
                                    if (isset($request_data["optiondel_" . ($i + 1) . "_" . ($j + 1)]) && $request_data["optiondel_" . ($i + 1) . "_" . ($j + 1)]) {
                                        $formoption = $this->Formoptions->get($request_data["optiondel_" . ($i + 1) . "_" . ($j + 1)]);
                                    } else {
                                        $formoption = $this->Formoptions->newEntity();
                                    }


                                    $formoption->formdetail_id = $save_form_details->id;
                                    $formoption->option_name = $request_data["form_option_" . ($i + 1) . "_" . ($j + 1)];
                                    $save_formoption = $this->Formoptions->save($formoption);
                                }
                            }
                        }
                    }
                }
                //'remove_field_user' => '',
                //'remove_options_user' => '16,15'
                if ($request_data['remove_field_user']) {

                    //$remove_field_user = explode(',',$request_data['remove_field_user']);
                    $this->Formdetails->deleteAll(array('id in (' . $request_data['remove_field_user'] . ')'));
                    // $this->Formdetails->delete()->where(["id in(".$request_data['remove_field_user'].")"]);
                }
                if ($request_data['remove_options_user']) {
                    //$this->Formoptions->delete()->where(["id in(".$request_data['remove_options_user'].")"]);
                    $this->Formoptions->deleteAll(array('id in (' . $request_data['remove_options_user'] . ')'));
                }


                $this->Flash->success(__('The form has been saved.'), ["key" => "positive"]);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The form could not be saved. Please, try again.'), ["key" => "negative"]);
        }

        $total_field = count($form['formdetails']);
        $this->set(compact('total_field'));
        $this->set(compact('form'));
        $this->set('_serialize', ['form', 'total_field']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Form id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        //this->request->allowMethod(['post', 'delete']);
        $form = $this->Forms->get($id);
        if ($this->Forms->delete($form)) {
            $this->Flash->success(__('The form has been deleted.'),["key" => "positive"]);
        } else {
            $this->Flash->error(__('The form could not be deleted. Please, try again.'), ["key" => "negative"]);
        }

        return $this->redirect(['action' => 'index']);
    }

}
