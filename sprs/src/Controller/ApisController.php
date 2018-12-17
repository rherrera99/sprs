

<?php
/* This is the main file for all apis which are using in angular application
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * */
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use Cake\Cache\Cache;
use \Twilio\Rest\Client;

//$braintreeConfig = Configure::read("BraintreeConfig");
//\Braintree_Configuration::environment($braintreeConfig["env"]);
//\Braintree_Configuration::merchantId($braintreeConfig["merchant_id"]);
//\Braintree_Configuration::publicKey($braintreeConfig["public_key"]);
//\Braintree_Configuration::privateKey($braintreeConfig["private_key"]);

/**
 * Apis Controller
 *
 */
class ApisController extends AppController {

    public $header;
	
	
	/*
	 * 
	 * 
	 * Initialize method is used for auntenticate the doctors/patients for all api using request headers.
	 * 
	 * */
    public function initialize() {
        $this->loadComponent('RequestHandler');
        parent::initialize();

        $this->Auth->allow();
        $autharr = array('doctorLogin', 'patientLogin', 'patientDetails', 'drDetails', 'addDrPatient', 'getDrPatientList', 'editProfile', 'editdrProfile', 'getallFromlist', 'getUserAddForm', 'addptReading', 'getptreadings', 'setDashboardData', 'setTabledData', 'viewReadingId', 'fileUpload', 'ptchnagepass', 'ptforgot', 'ptforgotAddnew', 'resetPassword', 'drforgot', 'drchnagepass', 'fileUploaddr', 'addptReadingFile', 'base64upload', 'userTimezone');
        $this->header = apache_request_headers();
        //debug(in_array($this->request->params['action'], $autharr));
        // && !$this->__isDriverAuthenticated($this->header['app_token'])
        if (!in_array($this->request->params['action'], $autharr)) {
            //debug($this->request->params['action']);
            if (isset($this->header['app_token'])) {
                if (!$this->__isDoctorAuthenticated($this->header['app_token']) && !$this->__isPatientAuthenticated($this->header["app_token"])) {
                    $res['status'] = Configure::read('SUCCESS_401');
                    $res['message'] = Configure::read('UNAUTHENTICATED_CUSTOMER');
                    echo json_encode($res);
                    exit();
                }
            } else {
                $res['status'] = Configure::read('SERVER_ERROR_CODE');
                $res['message'] = Configure::read('INVALID_PARAMETER');
                echo json_encode($res);
                exit();
            }
        }
    }
	/*
	 * Function is used for Authenticate doctor using app_token
	 * 
	 * */
    public function __isDoctorAuthenticated($app_token) {

        $device = TableRegistry::get('Doctors');
        $customercount = $device->find()
                ->where(['Doctors.app_token' => $app_token])
                ->count();

        if ($customercount == 1) {
            return true;
        } else {
            return false;
        }
    }
	// Function is used for Authenticate patient using app_token
    public function __isPatientAuthenticated($app_token) {

        $device = TableRegistry::get('Patients');
        $customercount = $device->find()
                ->where(['Patients.app_token' => $app_token])
                ->count();

        if ($customercount == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Doctor Login
     * 
     * Request Parameters: username,password
     */
    public function doctorLogin() {
        if ($this->request->data) {
            $data = $this->request->data;
            $mendatoryParameters = array('username', 'password');
            if ($this->__checkRequestData($mendatoryParameters, $data)) {
                $this->Doctors = TableRegistry::get('Doctors');
                //       $data['device_token'] = !empty($data['device_token']) ? $data['device_token'] : "";
                //     $data['device_type'] = !empty($data['device_type']) ? $data['device_type'] : "";
                //$data['build_version'] = !empty($data['build_version']) ? $data['build_version'] : "";
                $doctor = $this->Doctors->authenticateDoctor($data['username'], $data['password']);
//                /debug( $doctor);
                if (!empty($doctor)) {
                    if ($doctor->status == 1 && $doctor->is_delete != 1) {
                        $app_token = $this->__getGUID();
                        $doctor->app_token = $app_token;
                        $doctor->last_login = date("Y-m-d H:i:s");
                        $this->Doctors->save($doctor);
                        if ($doctor->profile_pic) {
                            $doctor->profile_pic = Configure::read("DOCTOR_PROFILE_URL") . $doctor->profile_pic;
                        } else {
                            $doctor->profile_pic = Configure::read("DEFAULT_AVTAR");
                        }
                        $doctor->first_name = "Dr " . $doctor->first_name;
                        $doctor->last_name = $doctor->last_name;
                        $doctor->designation = $doctor->designation;
                        $response['status'] = Configure::read('RESPONSE_SUCCESS_CODE');
                        $response['message'] = "Success";
                        $response['data']['doctorinfo'] = $doctor;
                    } else {
                        $response['status'] = Configure::read('SERVER_ERROR_CODE');
                        $response['message'] = Configure::read('LOGIN_FAILED');
                    }
                } else {
                    $response['status'] = Configure::read('SERVER_ERROR_CODE');
                    $response['message'] = Configure::read('LOGIN_FAILED');
                }
            } else {
                $response['status'] = Configure::read('INSUFFICIENT_PARAMETERS_CODE');
                $response['message'] = Configure::read('INSUFFICIENT_PARAMETERS');
            }
        } else {
            $response['status'] = Configure::read('FORBIDDEN_ERROR_CODE');
            $response['message'] = Configure::read('FORBIDDEN');
        }
        $this->__serialize($response);
    }
	/**
     * Doctor Login
     * 
     * Request Parameters: username,password
     */
    public function patientLogin() {
        //echo "hello";
        //debug($_POST);
        if ($this->request->data) {
            //debug($this->request->data);
            $data = $this->request->data;
            $mendatoryParameters = array('username', 'password');
            if ($this->__checkRequestData($mendatoryParameters, $data)) {
                $this->Patients = TableRegistry::get('Patients');
                //$data['build_version'] = !empty($data['build_version']) ? $data['build_version'] : "";
                $patient = $this->Patients->authenticatePatient($data['username'], $data['password']);

                if (!empty($patient)) {
                    if ($patient->status == 1 && $patient->is_delete != 1) {
                        $app_token = $this->__getGUID();
                        $patient->app_token = $app_token;
                        $patient->last_login = date("Y-m-d H:i:s");
                        $this->Patients->save($patient);
                        if ($patient->profile_pic) {
                            $patient->profile_pic = Configure::read("PATIENT_PROFILE_URL") . $patient->profile_pic;
                        } else {
                            $patient->profile_pic = Configure::read("DEFAULT_AVTAR");
                        }

                        $dob = $patient->dob;
                        $cur_date = date("Y-m-d");
                        $datetime1 = date_create($dob);
                        $datetime2 = date_create($cur_date);

                        $interval = date_diff($datetime1, $datetime2);




                        $difference = $interval->format("%y");

                        $patient->Dob = $difference == 0 ? "" : $difference . " YEARS";

                        $response['status'] = Configure::read('RESPONSE_SUCCESS_CODE');
                        $response['message'] = "Success";
                        $response['data']['patientinfo'] = $patient;
                    } else {
                        $response['status'] = Configure::read('SERVER_ERROR_CODE');
                        $response['message'] = Configure::read('INACTIVE_RIDER');
                    }
                } else {
                    $response['status'] = Configure::read('SERVER_ERROR_CODE');
                    $response['message'] = Configure::read('LOGIN_FAILED');
                }
            } else {
                $response['status'] = Configure::read('INSUFFICIENT_PARAMETERS_CODE');
                $response['message'] = Configure::read('INSUFFICIENT_PARAMETERS');
            }
        } else {
            $response['status'] = Configure::read('FORBIDDEN_ERROR_CODE');
            $response['message'] = Configure::read('FORBIDDEN');
        }
        $this->__serialize($response);
    }

    /**
     * Get patient Details
     * 
     * Request Parameters: user_id
     */
    public function patientDetails() {
        //echo "dsasa";exit();
        if ($this->request->data) {
            $data = $this->request->data;
            $mendatoryParameters = array('user_id');
            if ($this->__checkRequestData($mendatoryParameters, $data)) {
                $this->patients = TableRegistry::get('patients');
                $condition = ["patients.id" => $data['user_id']];
                $patients = $this->patients->find()->where($condition)->toArray();

                //debug($patients);
                if ($patients[0]->profile_pic) {
                    $patients[0]->profile_pic = Configure::read("PATIENT_PROFILE_URL") . $patients[0]->profile_pic;
                } else {
                    $patients[0]->profile_pic = Configure::read("DEFAULT_AVTAR");
                }

                if ($patients[0]->gender) {
                    $gender = Configure::read("GENDER")[$patients[0]->gender];
                    $patients[0]['gender_p'] = $patients[0]->gender . "";
                    $patients[0]['gender'] = $gender;
                } else {
                    $patients[0]['gender_p'] = "";
                    $patients[0]['gender'] = "";
                }
                if ($patients[0]->weight) {

                    $patients[0]->weight = $patients[0]->weight;
                } else {
                    $patients[0]->weight = 0;
                }

                $datetime1 = date_create(date('Y-m-d H:i:s'));
                $datetime2 = date_create($patients[0]->dob);

                $interval = date_diff($datetime1, $datetime2);

                $timezone = $this->userTimezone($data['timezone']);

                $joindate = CommonController::convertToUserTimeZoneFront($patients[0]->created, $timezone);
                $patients[0]['joindate'] = $joindate;

                $lastlogin = CommonController::convertToUserTimeZoneFront($patients[0]->last_login, $timezone);
                $patients[0]['last_login'] = $lastlogin;

                $age = $interval->y;
                $patients[0]['age'] = $age == 0 ? "" : $age . " Years";
                $patients[0]->dob = date('Y-m-d', strtotime($patients[0]->dob));
                //;



                if (!empty($patients)) {

                    $response['status'] = Configure::read('RESPONSE_SUCCESS_CODE');
                    $response['message'] = Configure::read('SUCCESS');
                    $response['data']['patientinfo'] = $patients;
                } else {
                    $response['status'] = Configure::read('SERVER_ERROR_CODE');
                    $response['message'] = Configure::read('NO_RECORD_FOUND');
                }
            } else {
                $response['status'] = Configure::read('INSUFFICIENT_PARAMETERS_CODE');
                $response['message'] = Configure::read('INSUFFICIENT_PARAMETERS');
            }
        } else {
            $response['status'] = Configure::read('FORBIDDEN_ERROR_CODE');
            $response['message'] = Configure::read('FORBIDDEN');
        }

        $this->__serialize($response);
    }
	/**
     * Get doctor Details
     * 
     * Request Parameters: dr_id
     */
    public function drDetails() {
        if ($this->request->data) {
            $data = $this->request->data;
            $mendatoryParameters = array('dr_id');
            if ($this->__checkRequestData($mendatoryParameters, $data)) {
                $this->doctors = TableRegistry::get('doctors');
                $condition = ["doctors.id" => $data['dr_id']];
                $doctor = $this->doctors->find()->where($condition)->toArray();

                if ($doctor[0]->profile_pic) {
                    $doctor[0]->profile_pic = Configure::read("DOCTOR_PROFILE_URL") . $doctor[0]->profile_pic;
                } else {
                    $doctor[0]->profile_pic = Configure::read("DEFAULT_AVTAR");
                }

                $timezone = $this->userTimezone($data['timezone']);

                $joindate = CommonController::convertToUserTimeZoneFront($doctor[0]->created, $timezone);
                $doctor[0]['joindate'] = $joindate;

                $lastlogin = CommonController::convertToUserTimeZoneFront($doctor[0]->last_login, $timezone);
                $doctor[0]['last_login'] = $lastlogin;
              
                $doctor[0]['name'] = "Dr " . $doctor[0]->first_name . ' ' . $doctor[0]->last_name;
                if ($doctor[0]->gender) {
                    $doctor[0]['gender_p'] = $doctor[0]->gender . "";
                    $gender = Configure::read("GENDER")[$doctor[0]->gender];
                    $doctor[0]['gender'] = $gender;
                } else {
                    $doctor[0]['gender'] = "";
                    $doctor[0]['gender_p'] = "";
                }
                if (!empty($doctor)) {

                    $response['status'] = Configure::read('RESPONSE_SUCCESS_CODE');
                    $response['message'] = Configure::read('SUCCESS');
                    $response['data']['drinfo'] = $doctor;
                } else {
                    $response['status'] = Configure::read('SERVER_ERROR_CODE');
                    $response['message'] = Configure::read('NO_RECORD_FOUND');
                }
            } else {
                $response['status'] = Configure::read('INSUFFICIENT_PARAMETERS_CODE');
                $response['message'] = Configure::read('INSUFFICIENT_PARAMETERS');
            }
        } else {
            $response['status'] = Configure::read('FORBIDDEN_ERROR_CODE');
            $response['message'] = Configure::read('FORBIDDEN');
        }

        $this->__serialize($response);
    }
	/*
	 * Function Name: addDrPatient
	 * Use:  Adding patient from doctor side and sending mail to patients for username and password
	 * 
	 * 
	 * 
	 * */
    public function addDrPatient() {

        //debug($this->request->data); exit();

        $this->Users = TableRegistry::get('Users');
        $admin = $this->Users->find()->where(["role_id" => 1])->hydrate(false)->toArray();

        if ($this->request->data) {
            $data = $this->request->data;
            $mendatoryParameters = array('dr_id');
            if ($this->__checkRequestData($mendatoryParameters, $data)) {
                $this->Patients = TableRegistry::get('Patients');

                $getmail = $this->Patients->find()->where(["email" => $data['email']])->hydrate(false)->toArray();
                if (count($getmail) > 0) {

                    $response['status'] = Configure::read('FAIL');
                    $response['message'] = "An user already registered with this email address";
                } else {

                    $patient = $this->Patients->newEntity();

                    $patient->first_name = $data["first_name"];
                    $patient->last_name = $data["last_name"];
                    $patient->email = $data["email"];
                    $patient->contact_no = $data["contact_no"];

                    $forEmailPass = strtoupper(substr($data["first_name"], 0, 2) . "" . substr($data["last_name"], strlen($data["email"]) - 2, 2) . "" . substr($data["contact_no"], strlen($data["contact_no"]) - 5, 2) . "" . substr($data["contact_no"], strlen($data["contact_no"]) - 1, 1) . "" . substr($data["contact_no"], strlen($data["contact_no"]) - 4, 1));
                    $patient->password = $forEmailPass;

                    $addPatient = $this->Patients->save($patient);
                    if ($addPatient->id) {

                        $this->Draddpatients = TableRegistry::get('Draddpatients');
                        $draddpatient = $this->Draddpatients->newEntity();

                        $draddpatient->doctor_id = $data['dr_id'];
                        $draddpatient->patient_id = $addPatient->id;

                        //$draddpatient->forms_list = trim(json_encode($data['form_list']), '[]');
                        $Draddpatient = $this->Draddpatients->save($draddpatient);

                        //$Draddpatient = true;


                        $forms_list_data = explode(',', trim(json_encode($data['form_list']), '[]'));

                        foreach ($forms_list_data as $forms_list) {
                            $this->AllocatedForms = TableRegistry::get('AllocatedForms');
                            $allocatedform = $this->AllocatedForms->newEntity();
                            $allocatedform->draddpatient_id = $Draddpatient->id;
                            $allocatedform->form_id = $forms_list;
                            $this->AllocatedForms->save($allocatedform);
                        }


                        if ($Draddpatient) {


                            CommonController::sendRegisterMailToCustomer($data["email"], $data["first_name"] . " " . $data["last_name"], $admin[0], $forEmailPass, $data['dr_id']);


                            $response['status'] = Configure::read('RESPONSE_SUCCESS_CODE');
                            $response['message'] = Configure::read('SUCCESS');
                        } else {

                            $response['status'] = Configure::read('SERVER_ERROR_CODE');
                            $response['message'] = "Something Worng";
                        }
                    } else {
                        $response['status'] = Configure::read('SERVER_ERROR_CODE');
                        $response['message'] = Configure::read('NO_RECORD_FOUND');
                    }
                }
            } else {
                $response['status'] = Configure::read('INSUFFICIENT_PARAMETERS_CODE');
                $response['message'] = Configure::read('INSUFFICIENT_PARAMETERS');
            }
        } else {
            $response['status'] = Configure::read('FORBIDDEN_ERROR_CODE');
            $response['message'] = Configure::read('FORBIDDEN');
        }

        $this->__serialize($response);
    }
	/*
	 * Function Name: getDrPatientList
	 * Use:  Getting all patients list for perticular doctor
	 * 
	 * 
	 * 
	 * */
    public function getDrPatientList() {

        if ($this->request->data) {
            $data = $this->request->data;
            $mendatoryParameters = array('dr_id');
            if ($this->__checkRequestData($mendatoryParameters, $data)) {
                $this->Draddpatients = TableRegistry::get('Draddpatients');


                $condition = ["Draddpatients.doctor_id" => $data['dr_id']];
                $doctor = $this->Draddpatients->find()->contain(["Patients"])->where($condition)->hydrate(false)->toArray();

                $set_data = array();
                foreach ($doctor as $Patient) {

                    if ($Patient['patient']['profile_pic']) {
                        $patient_contact_no = Configure::read("PATIENT_PROFILE_URL") . $Patient['patient']['profile_pic'];
                    } else {
                        $patient_contact_no = Configure::read("DEFAULT_AVTAR");
                    }
                    $set_data[] = array(
                        'id' => $Patient['id'],
                        'patient_id' => $Patient['patient_id'],
                        'patient_name' => $Patient['patient']['first_name'] . " " . $Patient['patient']['last_name'],
                        'patient_address' => $Patient['patient']['address'],
                        'patient_Email' => $Patient['patient']['email'],
                        'patient_contact_no' => $Patient['patient']['contact_no'],
                        'patient_profile' => $patient_contact_no
                    );
                }

                if (!empty($set_data)) {

                    $response['status'] = Configure::read('RESPONSE_SUCCESS_CODE');
                    $response['message'] = Configure::read('SUCCESS');
                    $response['data']['patientlist'] = $set_data;
                } else {
                    $response['status'] = Configure::read('SERVER_ERROR_CODE');
                    $response['message'] = Configure::read('NO_RECORD_FOUND');
                }
            } else {
                $response['status'] = Configure::read('INSUFFICIENT_PARAMETERS_CODE');
                $response['message'] = Configure::read('INSUFFICIENT_PARAMETERS');
            }
        } else {
            $response['status'] = Configure::read('FORBIDDEN_ERROR_CODE');
            $response['message'] = Configure::read('FORBIDDEN');
        }

        $this->__serialize($response);
    }
	/*
	 * Function Name: editProfile
	 * Use:  For editing the profile of patients
	 * 
	 * 
	 * 
	 * */
    public function editProfile() {


        if ($this->request->data) {
            $data = $this->request->data;
            $mendatoryParameters = array('user_id');
            if ($this->__checkRequestData($mendatoryParameters, $data)) {

                $this->Patients = TableRegistry::get('Patients');
                $patient = $this->Patients->get($data['user_id']);


                $patient->first_name = $data["first_name"];
                $patient->last_name = $data["last_name"];
                $patient->email = $data["email"];
                $patient->contact_no = $data["contact_no"];

                $patient->dob = $data["dob"];
                $patient->address = $data["address"];
                $patient->height = $data["height"];
                $patient->weight = $data["weight"];

                $patient->gender = $data["gender"];
                $patient->about = $data["about"];
                //$this->Patients->save($patient);



                if ($this->Patients->save($patient)) {

                    $response['status'] = Configure::read('RESPONSE_SUCCESS_CODE');
                    $response['message'] = Configure::read('SUCCESS');
                } else {
                    $response['status'] = Configure::read('SERVER_ERROR_CODE');
                    $response['message'] = Configure::read('NO_RECORD_FOUND');
                }
            } else {
                $response['status'] = Configure::read('INSUFFICIENT_PARAMETERS_CODE');
                $response['message'] = Configure::read('INSUFFICIENT_PARAMETERS');
            }
        } else {
            $response['status'] = Configure::read('FORBIDDEN_ERROR_CODE');
            $response['message'] = Configure::read('FORBIDDEN');
        }

        $this->__serialize($response);
    }
	/*
	 * Function Name: getUserAddForm
	 * Use:  Get all the forms which already allocated to patient by doctor
	 * 
	 * 
	 * 
	 * */
    public function getUserAddForm() {

        if ($this->request->data) {

            $this->Forms = TableRegistry::get('Forms');
            $this->Formoptions = TableRegistry::get('Formoptions');
            $this->Formdetails = TableRegistry::get('Formdetails');
            $this->AllocatedForms = TableRegistry::get('AllocatedForms');


            $data = $this->request->data;
            $mendatoryParameters = array('user_id');
            if ($this->__checkRequestData($mendatoryParameters, $data)) {

                $this->Draddpatients = TableRegistry::get('Draddpatients');

                $draddpatients = $this->Draddpatients->find('all')
                                ->contain(["AllocatedForms", "AllocatedForms.Forms", "AllocatedForms.Forms.Formdetails", "AllocatedForms.Forms.Formdetails.Formoptions"])
                                ->where(['patient_id =' => $data['user_id']])->hydrate(false)->toArray();


                //echo json_encode($draddpatients);
                $newlist_data = array();
                foreach ($draddpatients[0]['allocated_forms'] as $foarms_list) {
                    $form_details = array();
                    foreach ($foarms_list['form']['formdetails'] as $formdatiels) {
                        $units = array();
                        if ($formdatiels["units"]) {
                            $units = json_decode($formdatiels["units"], true);
                        }
                        $formdatiels["units"] = $units;
                        array_push($form_details, $formdatiels);
                        //print_r($foarms_list);exit();
                    }

                    $foarms_list['form']['allcated_id'] = $foarms_list['id'];
                    $foarms_list['form']['formdetails'] = $form_details;
                    array_push($newlist_data, $foarms_list['form']);
                }
                //exit();
                //$allocatedforms = $this->AllocatedForms->find('all')
                // ->where(['draddpatient_id =' => $draddpatients[0]['id']])->hydrate(false)->toArray();
                //  print_r($draddpatients[0]['allocated_forms']);
                //exit();
//                
//                $form_list='';
//                if($draddpatients[0]['forms_list']){
//                $conditionofarray = ["Forms.id in (" . $draddpatients[0]['forms_list'] . ")"];
//                $form_list = $this->Forms->find('all')
//                                ->contain(["Formdetails", "Formdetails.Formoptions"])
//                                ->where($conditionofarray)
//                               ->hydrate(false)->toArray();
//      }

                if ($draddpatients) {

                    $response['status'] = Configure::read('RESPONSE_SUCCESS_CODE');
                    $response['message'] = Configure::read('SUCCESS');
                    //$response['data']['formlist'] = $draddpatients[0]['allocated_forms'];
                    $response['data']['formlist'] = $newlist_data;
                } else {
                    $response['status'] = Configure::read('SERVER_ERROR_CODE');
                    $response['message'] = Configure::read('NO_RECORD_FOUND');
                }
            } else {
                $response['status'] = Configure::read('INSUFFICIENT_PARAMETERS_CODE');
                $response['message'] = Configure::read('INSUFFICIENT_PARAMETERS');
            }
        } else {
            $response['status'] = Configure::read('FORBIDDEN_ERROR_CODE');
            $response['message'] = Configure::read('FORBIDDEN');
        }

        $this->__serialize($response);
    }
	/*
	 * Function Name: getUserAddForm
	 * Use:  Get all formlist which is created by admin
	 * 
	 * 
	 * 
	 * */
    public function getallFromlist() {

        $this->Forms = TableRegistry::get('Forms');
        $form_list = $this->Forms->find()->select(['id', 'form_name'])->hydrate(false)->toArray();

        if ($form_list) {

            $response['status'] = Configure::read('RESPONSE_SUCCESS_CODE');
            $response['message'] = Configure::read('SUCCESS');
            $response['data']['form_list'] = $form_list;
        } else {
            $response['status'] = Configure::read('SERVER_ERROR_CODE');
            $response['message'] = Configure::read('NO_RECORD_FOUND');
        }
        $this->__serialize($response);
    }
	
	/*
	 * Function Name: getUserAddForm
	 * Use:  This function record  the reading details added by patients
	 * 
	 * 
	 * 
	 * */

    public function addptReading() {


        if ($this->request->data) {
            //print_r($this->request->data);
            //exit();
            $data = $this->request->data;
            $mendatoryParameters = array('user_id');
            if ($this->__checkRequestData($mendatoryParameters, $data)) {

                $this->Ptreadings = TableRegistry::get('Ptreadings');



                $ptreading = $this->Ptreadings->newEntity();

                $ptreading->allocated_form_id = $data["form_allcated_id"];

                $addptreading = $this->Ptreadings->save($ptreading);



                $this->Ptreadingdetails = TableRegistry::get('Ptreadingdetails');

                foreach ($data['form_data'] as $form_data) {

                    $ptreadingdetails = $this->Ptreadingdetails->newEntity();
                    $ptreadingdetails->ptreading_id = $addptreading->id;
                    $ptreadingdetails->formdetail_id = $form_data["field_id"];
                    $ptreadingdetails->formdetail_name = $form_data["field_name"];
                    if ($form_data["field_type"] == 5) {

                        $ptreadingdetails->reading_value = json_encode($form_data["value"]);
                    } elseif ($form_data["field_type"] == 9) {

                        $image_name = $this->base64upload($form_data["value"], $data["user_id"], \Cake\Core\Configure::read("READING_PATH"));
                        $ptreadingdetails->reading_value = $image_name;
                    } else {

                        $ptreadingdetails->reading_value = $form_data["value"];
                    }

                    $ptreadingdetails->reading_option = $form_data["options"];
                    $ptreadingdetails->is_dashboard = $form_data["is_dashboard"];
                    $ptreadingdetails->is_table = $form_data["is_table"];
                    $ptreadingdetails->units = $form_data["units"];

                    $this->Ptreadingdetails->save($ptreadingdetails);
                }





                if ($addptreading->id) {


                    $response['status'] = Configure::read('RESPONSE_SUCCESS_CODE');
                    $response['message'] = Configure::read('SUCCESS');
                } else {

                    $response['status'] = Configure::read('SERVER_ERROR_CODE');
                    $response['message'] = "Something Worng";
                }
            } else {
                $response['status'] = Configure::read('INSUFFICIENT_PARAMETERS_CODE');
                $response['message'] = Configure::read('INSUFFICIENT_PARAMETERS');
            }
        } else {
            $response['status'] = Configure::read('FORBIDDEN_ERROR_CODE');
            $response['message'] = Configure::read('FORBIDDEN');
        }

        $this->__serialize($response);
    }

	/*
	 * Function Name: getUserAddForm
	 * Use:  Get already added reading of perticular patients 
	 * 
	 * 
	 * 
	 * */

    public function getptreadings() {

        if ($this->request->data) {
            $data = $this->request->data;
            $mendatoryParameters = array('user_id');
            if ($this->__checkRequestData($mendatoryParameters, $data)) {

                $this->Ptreadings = TableRegistry::get('Ptreadings');
                $this->Draddpatients = TableRegistry::get('Draddpatients');
                $condition['patient_id'] = $data['user_id'];
                $draddpatients = $this->Draddpatients->find()->contain(["AllocatedForms"])->where($condition)->hydrate(false)->toArray();
                $allocatedforms_id = array();
                foreach ($draddpatients[0]['allocated_forms'] as $key => $value) {
                    array_push($allocatedforms_id, $value['id']);
                }

                if ($allocatedforms_id) {
                    $condition = ['allocated_form_id in (' . implode(",", $allocatedforms_id) . ')'];


                    $ptreadings = $this->Ptreadings->find('all')
                                    ->contain(["AllocatedForms.Forms", "AllocatedForms", "Ptreadingdetails"])
                                    ->where($condition)->order(["Ptreadings.created" => "DESC"])->hydrate(false)->toArray();

                    //  debug(json_encode($ptreadings));
                    $setFormData = array();
                    $setFormDatatemp = array();

                    foreach ($ptreadings as $key => $value) {

                        if (isset($setFormDatatemp[$value['allocated_form']['form']['id']])) {
                            //echo "yes";
                        } else {

                            $setFormDatatemp[$value['allocated_form']['form']['id']] = $value['allocated_form']['form']['id'];

                            $getDashboardData = self :: setDashboardData($value["id"]);
                            $getTabledData = self :: setTabledData($value['allocated_form_id'], $data);

                            $singl = array('form_id' => $value['allocated_form']['form']['id'], 'form_name' => $value['allocated_form']['form']['form_name'], 'DashboardData' => $getDashboardData, 'TabledData' => $getTabledData, "latest_reading_id" => $value["id"]);
                            $setFormData[$value['allocated_form']['form']['id']] = $singl;
                        }
                    }
                    $final_data = array();
                    foreach ($setFormData as $key => $value) {
                        array_push($final_data, $value);
                    }




                    if ($final_data) {

                        $response['status'] = Configure::read('RESPONSE_SUCCESS_CODE');
                        $response['message'] = Configure::read('SUCCESS');
                        //$response['data']['formlist'] = $draddpatients[0]['allocated_forms'];
                        $response['data']['readinglist'] = $final_data;
                    } else {
                        $response['status'] = Configure::read('SERVER_ERROR_CODE');
                        $response['message'] = Configure::read('NO_RECORD_FOUND');
                    }
                } else {
                    $response['status'] = Configure::read('SERVER_ERROR_CODE');
                    $response['message'] = Configure::read('NO_RECORD_FOUND');
                }
                //debug(json_encode($draddpatients));exit();
            } else {
                $response['status'] = Configure::read('INSUFFICIENT_PARAMETERS_CODE');
                $response['message'] = Configure::read('INSUFFICIENT_PARAMETERS');
            }
        } else {
            $response['status'] = Configure::read('FORBIDDEN_ERROR_CODE');
            $response['message'] = Configure::read('FORBIDDEN');
        }

        $this->__serialize($response);
    }
	/*
	 * Function Name: setDashboardData
	 * Use:  Use this function for displaying dashboard data 
	 * 
	 * 
	 * 
	 * */
    public function setDashboardData($getData) {

        $dashboard_data = array();
        //echo $getData;


        $table_data = array();
        $is_dash = array();
        $is_tablevalue = array();

        // echo $getData;
        $this->Ptreadingdetails = TableRegistry::get('Ptreadingdetails');
        //$condition = ['ptreadings.allocated_form_id=1 and formdetails.formdetails.is_table="1"'];->where($condition)
        $ptreadings = $this->Ptreadingdetails->find('all')
                        ->contain(['Ptreadings', 'Formdetails'])
                        ->where(['Ptreadings.id="' . $getData . '" AND Formdetails.is_dashboard="1"'])
                        ->hydrate(false)->limit(4)->toArray();


        foreach ($ptreadings as $ptreading) {
            array_push($is_dash, array('is_dashboard_name' => $ptreading['formdetail_name'], 'is_dashboard_value' => $ptreading['reading_value'] . " " . $ptreading['units']));
            // $is_dash[$ptreading['formdetail_name']] = $ptreading['reading_value']; //array('is_dashboard_name' => $ptreadingdetails['formdetail_name'], 'is_dashboard_value' => $ptreadingdetails['reading_value']);
        }
//         array_push($dashboard_data, $is_dash);
//        $dashboard_data_final=array();
//            foreach ($dashboard_data as $key => $value) {
//                $is_dash_new = array();
//                $is_dash_new = array('is_dashboard_name' => $key, 'is_dashboard_value' => $value);
//                array_push($dashboard_data_final, $is_dash_new);
//            }
        //  print_r($is_dash);exit();
//        $datacount = count($getData['ptreadings']);
//
//        $is_dash = array();
//        foreach ($getData['ptreadings'] as $ptreadings) {
//
//
//            foreach ($ptreadings['ptreadingdetails'] as $ptreadingdetails) {
//
//
//                if ($ptreadingdetails['is_dashboard'] == '1') {
//
////                    if(array_key_exists($ptreadingdetails['formdetail_name'],$dashboard_data)){
////                        
////                        echo "asas";
////                    }  else {
////                    echo "nanan";    
////                    print_r($dashboard_data);
////                    }
//
//                    $is_dash[$ptreadingdetails['formdetail_name']] = $ptreadingdetails['reading_value']; //array('is_dashboard_name' => $ptreadingdetails['formdetail_name'], 'is_dashboard_value' => $ptreadingdetails['reading_value']);
//                    //array_push($dashboard_data, $is_dash);
//                }
//            }
//        }
//        if ($is_dash) {
//            foreach ($is_dash as $key => $value) {
//                $is_dash_new = array();
//                $is_dash_new = array('is_dashboard_name' => $key, 'is_dashboard_value' => $value);
//                array_push($dashboard_data, $is_dash_new);
//            }
//        }

        return $is_dash;
    }
	/*
	 * Function Name: setTabledData
	 * Use:  Use this function in getPtReading for geting the tableformed data
	 * 
	 * 
	 * 
	 * */
    public function setTabledData($getData, $data) {
        $table_data = array();
        $is_dash = array();
        $is_tablevalue = array();
        $condition = [];
        if (isset($data["from_date"]) && $data["from_date"] != '' && isset($data["to_date"]) && $data["to_date"] != '') {

            $condition['date(Ptreadings.created) >= '] = $data["from_date"];
            $condition['date(Ptreadings.created) <= '] = $data["to_date"];
        }
        // echo $getData;
        $this->Ptreadingdetails = TableRegistry::get('Ptreadingdetails');
        //$condition = ['ptreadings.allocated_form_id=1 and formdetails.formdetails.is_table="1"'];->where($condition)
        $ptreadings = $this->Ptreadingdetails->find('all')
                        ->contain(['Ptreadings', 'Formdetails'])
                        ->where(['Ptreadings.allocated_form_id="' . $getData . '" AND Formdetails.is_table="1"', $condition])
                        ->hydrate(false)->toArray();

        // print_r(json_encode($ptreadings));exit();
//        foreach ($getData['ptreadings'] as $ptreadings) {
//            //print_r($ptreadings['ptreadingdetails']);
//            //array_push($is_table_value,$ptreadings["id"]);
        $is_table_value = array();
        foreach ($ptreadings as $ptreading) {

            //print_r($ptreading);
            if (in_array($ptreading['formdetail_name'], $is_dash)) {
                // echo "Match found<br/>";
            } else {
                //echo "Match not found<br/>";
                array_push($is_dash, $ptreading['formdetail_name']);
            }
            if (!isset($is_table_value[$ptreading["ptreading_id"]])) {
                $is_table_value[$ptreading["ptreading_id"]] = array();
            }
            array_push($is_table_value[$ptreading["ptreading_id"]], $ptreading['reading_value'] . " " . $ptreading['units']);
        }
        array_push($is_dash, 'Readings Date');

        foreach ($ptreadings as $ptreading) {
            if (!isset($is_tablevalue[$ptreading["ptreading_id"]])) {

                $timezone = $this->userTimezone($data['timezone']);

                $joindate = CommonController::convertToUserTimeZoneFront($ptreading['created'], $timezone);
//                /echo $joindate."<br>";
                array_push($is_table_value[$ptreading["ptreading_id"]], $joindate);
                $is_tablevalue[$ptreading["ptreading_id"]] = array("id" => $ptreading["ptreading_id"], "value" => $is_table_value[$ptreading["ptreading_id"]]);
            }
        }

        foreach ($is_tablevalue as $key => $value) {
            array_push($table_data, $value);
        }




//        }
//
        $finalTable = array('colum_name' => $is_dash, 'colum_value' => $table_data);
        //echo "<pre>";
        //print_r($is_dash);
        // print_r($finalTable);
        //exit();
        return $finalTable;
    }
	/*
	 * Function Name: viewReadingId
	 * Use:  Use this function to view the perticular data of added reading using id. 
	 * 
	 * 
	 * 
	 * */
    public function viewReadingId() {

        if ($this->request->data) {

            $data = $this->request->data;
            $this->ptreadingdetails = TableRegistry::get('ptreadingdetails');

            //$form_list = $this->Forms->find()->select(['id', 'form_name'])->hydrate(false)->toArray()->contain(["AllocatedForms", "AllocatedForms.Forms", "AllocatedForms.Ptreadings", "AllocatedForms.Ptreadings.Ptreadingdetails"]);
            $draddpatients = $this->ptreadingdetails->find('all')->contain(['Formdetails', 'Ptreadings'])->select(['formdetail_name', 'reading_value', 'reading_option', 'units', 'Formdetails.field_type', 'Ptreadings.created'])
                            ->where(['ptreading_id =' => $data['id']])->hydrate(false)->toArray();

            // print_r($draddpatients[0]['ptreading']['created']);exit();

            $timezone = $this->userTimezone($data['timezone']);

            $RedingDate = CommonController::convertToUserTimeZoneFront($draddpatients[0]['ptreading']['created'], $timezone);

            $readlist = array();
            foreach ($draddpatients as $value) {

                if ($value['reading_option'] == '1') {

                    // print_r($value['reading_value']);
                    $jdata = json_decode($value['reading_value']);
                    $final = "";
                    foreach ($jdata as $option) {

                        // print_r($option->value);
                        if ($final) {
                            $final.="," . $option->value;
                        } else {
                            $final.=$option->value;
                        }
                    }

                    $data = array('fname' => $value['formdetail_name'], 'fvalue' => $final . " " . $value['units']);
                } else {
                    $field_val = "";
                    if ($value['formdetail']['field_type'] == 9) {
                        $field_val = Configure::read("READING_URL") . '/' . $this->request->data['user_id'] . '/' . $value['reading_value'];
                    } else {
                        $field_val = $value['reading_value'] . " " . $value['units'];
                    }
                    $data = array('fname' => $value['formdetail_name'],
                        'fvalue' => $field_val, 'field_type' => $value['formdetail']['field_type']);
                }

                array_push($readlist, $data);
            }
            array_push($readlist, array('fname' => 'Reading Date',
                'fvalue' => $RedingDate, 'field_type' => '7'));
            if ($readlist) {

                $response['status'] = Configure::read('RESPONSE_SUCCESS_CODE');
                $response['message'] = Configure::read('SUCCESS');
                $response['data']['form_list'] = $readlist;
            } else {
                $response['status'] = Configure::read('SERVER_ERROR_CODE');
                $response['message'] = Configure::read('NO_RECORD_FOUND');
            }
        } else {
            $response['status'] = Configure::read('SERVER_ERROR_CODE');
            $response['message'] = Configure::read('NO_RECORD_FOUND');
        }
        $this->__serialize($response);
    }
	/*
	 * Function Name: editdrProfile
	 * Use:  Function use for editing dr profile. 
	 * 
	 * 
	 * 
	 * */
    public function editdrProfile() {


        if ($this->request->data) {
            $data = $this->request->data;
            $mendatoryParameters = array('dr_id');
            if ($this->__checkRequestData($mendatoryParameters, $data)) {

                $this->doctors = TableRegistry::get('doctors');
                $doctor = $this->doctors->get($data['dr_id']);


                $doctor->first_name = $data["first_name"];
                $doctor->last_name = $data["last_name"];
                $doctor->email = $data["email"];
                $doctor->contact_no = $data["contact_no"];

                $doctor->designation = $data["designation"];
                $doctor->address = $data["address"];
                $doctor->education = $data["education"];
                $doctor->about = $data["about"];
                $doctor->gender = $data["gender"];




                if ($this->doctors->save($doctor)) {

                    $response['status'] = Configure::read('RESPONSE_SUCCESS_CODE');
                    $response['message'] = Configure::read('SUCCESS');
                } else {
                    $response['status'] = Configure::read('SERVER_ERROR_CODE');
                    $response['message'] = Configure::read('NO_RECORD_FOUND');
                }
            } else {
                $response['status'] = Configure::read('INSUFFICIENT_PARAMETERS_CODE');
                $response['message'] = Configure::read('INSUFFICIENT_PARAMETERS');
            }
        } else {
            $response['status'] = Configure::read('FORBIDDEN_ERROR_CODE');
            $response['message'] = Configure::read('FORBIDDEN');
        }

        $this->__serialize($response);
    }
	/*
	 * Function Name: fileUpload
	 * Use:  Function use for uploading profile pic 
	 * 
	 * 
	 * 
	 * */	
    public function fileUpload() {

        $this->Patients = TableRegistry::get('Patients');

        $data = $this->request->data;
        foreach ($data as $key => $value) {
            //echo 'key '.$key.'<br/>';
            $patient = $this->Patients->get($key, [
                'contain' => []
            ]);
            $profile_pic = \App\Controller\CommonController::uploadImages($value, $key, \Cake\Core\Configure::read("PATIENT_PROFILE_PATH"));
            if ($profile_pic["status"]) {
                $patient->profile_pic = $profile_pic["url"];
                if ($this->Patients->save($patient)) {

                    $response['status'] = Configure::read('RESPONSE_SUCCESS_CODE');
                    $response['message'] = Configure::read('SUCCESS');
                    $response['data']['img'] = \Cake\Core\Configure::read("PATIENT_PROFILE_URL") . $profile_pic["url"];
                } else {
                    $response['status'] = Configure::read('SERVER_ERROR_CODE');
                    $response['message'] = "Please try again after some time!!";
                }
            }
        }
        $this->__serialize($response);
    }
	/*
	 * Function Name: fileUploaddr
	 * Use:  Function use for uploading the dr profile pic
	 * 
	 * 
	 * 
	 * */	
    public function fileUploaddr() {

        $this->doctors = TableRegistry::get('doctors');

        $data = $this->request->data;
        foreach ($data as $key => $value) {
            //echo 'key '.$key.'<br/>';
            $patient = $this->doctors->get($key, [
                'contain' => []
            ]);
            $profile_pic = \App\Controller\CommonController::uploadImages($value, $key, \Cake\Core\Configure::read("DOCTOR_PROFILE_PATH"));
            if ($profile_pic["status"]) {
                $patient->profile_pic = $profile_pic["url"];
                if ($this->doctors->save($patient)) {

                    $response['status'] = Configure::read('RESPONSE_SUCCESS_CODE');
                    $response['message'] = Configure::read('SUCCESS');
                    $response['data']['img'] = \Cake\Core\Configure::read("DOCTOR_PROFILE_URL") . $profile_pic["url"];
                } else {
                    $response['status'] = Configure::read('SERVER_ERROR_CODE');
                    $response['message'] = "Please try again after some time!!";
                }
            }
        }
        $this->__serialize($response);
    }
	/*
	 * Function Name: addptReadingFile
	 * Use:  Function use for uploading the document available in reading
	 * 
	 * 
	 * 
	 * */	
    public function addptReadingFile() {

        $this->doctors = TableRegistry::get('doctors');
        $data = $this->request->data;
        print_r($data);
        foreach ($data as $key => $value) {
            //echo 'key '.$key.'<br/>';
//           $patient = $this->doctors->get($key, [
//            'contain' => []
//        ]);
            $profile_pic = \App\Controller\CommonController::uploadImages($value, $key . "sunil", \Cake\Core\Configure::read("DOCTOR_PROFILE_PATH"));
            if ($profile_pic["status"]) {
                //$patient->profile_pic = $profile_pic["url"];
                if ($profile_pic["status"]) {

                    //echo 'upload';
                } else {
                    // echo 'upload not';
                }
            }
        }
    }
	/*
	 * Function Name: ptchnagepass
	 * Use:  Function use for changing the patient password
	 * 
	 * 
	 * 
	 * */	
    public function ptchnagepass() {

        if ($this->request->data) {
            //debug($this->request->data);
            $data = $this->request->data;
            $mendatoryParameters = array('user_id', 'old', 'new');
            if ($this->__checkRequestData($mendatoryParameters, $data)) {
                $this->Patients = TableRegistry::get('Patients');
                //$data['build_version'] = !empty($data['build_version']) ? $data['build_version'] : "";
                $patient = $this->Patients->authenticatePatientPassword($data['user_id'], $data['old']);

                if ($patient) {

                    $patient = $this->Patients->get($data['user_id']);
                    $patient->password = $data["new"];
                    if ($this->Patients->save($patient)) {
                        $response['status'] = Configure::read('RESPONSE_SUCCESS_CODE');
                        $response['message'] = Configure::read('SUCCESS');
                    } else {
                        $response['status'] = Configure::read('SERVER_ERROR_CODE');
                        $response['message'] = "Please try again after some time!!";
                    }
                } else {
                    $response['status'] = Configure::read('SERVER_ERROR_CODE');
                    $response['message'] = 'Old Password not Match';
                }
            } else {
                $response['status'] = Configure::read('INSUFFICIENT_PARAMETERS_CODE');
                $response['message'] = Configure::read('INSUFFICIENT_PARAMETERS');
            }
        } else {
            $response['status'] = Configure::read('FORBIDDEN_ERROR_CODE');
            $response['message'] = Configure::read('FORBIDDEN');
        }
        $this->__serialize($response);
    }
	/*
	 * Function Name: ptchnagepass
	 * Use:  Function use for changing the doctor password
	 * 
	 * 
	 * 
	 * */	
    public function drchnagepass() {

        if ($this->request->data) {
            //debug($this->request->data);
            $data = $this->request->data;
            $mendatoryParameters = array('dr_id', 'old', 'new');
            if ($this->__checkRequestData($mendatoryParameters, $data)) {
                $this->Doctors = TableRegistry::get('Doctors');
                //$data['build_version'] = !empty($data['build_version']) ? $data['build_version'] : "";
                $patient = $this->Doctors->authenticateDoctorpassword($data['dr_id'], $data['old']);

                if ($patient) {

                    $patient = $this->Doctors->get($data['dr_id']);
                    $patient->password = $data["new"];
                    if ($this->Doctors->save($patient)) {
                        $response['status'] = Configure::read('RESPONSE_SUCCESS_CODE');
                        $response['message'] = Configure::read('SUCCESS');
                    } else {
                        $response['status'] = Configure::read('SERVER_ERROR_CODE');
                        $response['message'] = "Please try again after some time!!";
                    }
                } else {
                    $response['status'] = Configure::read('SERVER_ERROR_CODE');
                    $response['message'] = 'Old Password not Match';
                }
            } else {
                $response['status'] = Configure::read('INSUFFICIENT_PARAMETERS_CODE');
                $response['message'] = Configure::read('INSUFFICIENT_PARAMETERS');
            }
        } else {
            $response['status'] = Configure::read('FORBIDDEN_ERROR_CODE');
            $response['message'] = Configure::read('FORBIDDEN');
        }
        $this->__serialize($response);
    }
	/*
	 * Function Name: ptforgot
	 * Use:  Function use for forgot patinet password and sending mail to patient on registered email id
	 * 
	 * 
	 * 
	 * */	
    public function ptforgot() {

        if ($this->request->data) {
            //debug($this->request->data);
            $data = $this->request->data;
            $this->Users = TableRegistry::get('Users');
            $admin = $this->Users->find()->where(["role_id" => 1])->hydrate(false)->toArray();
            $mendatoryParameters = array('email');
            if ($this->__checkRequestData($mendatoryParameters, $data)) {
                $this->Patients = TableRegistry::get('Patients');
                //$data['build_version'] = !empty($data['build_version']) ? $data['build_version'] : "";
                $patient = $this->Patients->find()->where(['email' => $data['email']])->first();
                // debug($patient);
                if ($patient) {

                    CommonController::sendForgotPasswordToCustomer($data['email'], $patient->last_name . ' ' . $patient->last_name, $admin[0], $patient->id, $drId = '');


                    $response['status'] = Configure::read('RESPONSE_SUCCESS_CODE');
                    $response['message'] = Configure::read('SUCCESS');
                } else {
                    $response['status'] = Configure::read('SERVER_ERROR_CODE');
                    $response['message'] = 'Email not Match';
                }
            } else {
                $response['status'] = Configure::read('INSUFFICIENT_PARAMETERS_CODE');
                $response['message'] = Configure::read('INSUFFICIENT_PARAMETERS');
            }
        } else {
            $response['status'] = Configure::read('FORBIDDEN_ERROR_CODE');
            $response['message'] = Configure::read('FORBIDDEN');
        }
        $this->__serialize($response);
    }
	/*
	 * Function Name: drforgot
	 * Use:  Function use for forgot doctor password and sending mail to patient on registered email id
	 * 
	 * 
	 * 
	 * */
    public function drforgot() {

        if ($this->request->data) {
            //debug($this->request->data);
            $data = $this->request->data;
            $this->Users = TableRegistry::get('Users');
            $admin = $this->Users->find()->where(["role_id" => 1])->hydrate(false)->toArray();
            $mendatoryParameters = array('email');
            if ($this->__checkRequestData($mendatoryParameters, $data)) {
                $this->Doctors = TableRegistry::get('Doctors');
                //$data['build_version'] = !empty($data['build_version']) ? $data['build_version'] : "";
                $doctors = $this->Doctors->find()->where(['email' => $data['email']])->first();
                // debug($patient);
                if ($doctors) {

                    CommonController::sendForgotPasswordToCustomer($data['email'], $doctors->last_name . ' ' . $doctors->last_name, $admin[0], $patient = '', $doctors->id);


                    $response['status'] = Configure::read('RESPONSE_SUCCESS_CODE');
                    $response['message'] = Configure::read('SUCCESS');
                } else {
                    $response['status'] = Configure::read('SERVER_ERROR_CODE');
                    $response['message'] = 'Email not Match';
                }
            } else {
                $response['status'] = Configure::read('INSUFFICIENT_PARAMETERS_CODE');
                $response['message'] = Configure::read('INSUFFICIENT_PARAMETERS');
            }
        } else {
            $response['status'] = Configure::read('FORBIDDEN_ERROR_CODE');
            $response['message'] = Configure::read('FORBIDDEN');
        }
        $this->__serialize($response);
    }
	/*
	 * Function Name: ptforgotAddnew
	 * Use:  Function use for add new password after clicking the link availble in mail
	 * 
	 * 
	 * 
	 * */
    public function ptforgotAddnew() {

        if ($this->request->data) {
            //debug($this->request->data);
            $data = $this->request->data;
            $mendatoryParameters = array('user_id', 'password');
            if ($this->__checkRequestData($mendatoryParameters, $data)) {
                $this->Patients = TableRegistry::get('Patients');



                $patient = $this->Patients->get($data['user_id']);
                $patient->password = $data["password"];
                if ($this->Patients->save($patient)) {
                    $response['status'] = Configure::read('RESPONSE_SUCCESS_CODE');
                    $response['message'] = Configure::read('SUCCESS');
                } else {
                    $response['status'] = Configure::read('SERVER_ERROR_CODE');
                    $response['message'] = "Please try again after some time!!";
                }
            } else {
                $response['status'] = Configure::read('INSUFFICIENT_PARAMETERS_CODE');
                $response['message'] = Configure::read('INSUFFICIENT_PARAMETERS');
            }
        } else {
            $response['status'] = Configure::read('FORBIDDEN_ERROR_CODE');
            $response['message'] = Configure::read('FORBIDDEN');
        }
        $this->__serialize($response);
    }
	/*
	 * Function Name: resetPassword
	 * Use:  Function use for add new password after clicking the link availble in mail(Doctor/Patients)
	 * 
	 * 
	 * 
	 * */
    public function resetPassword() {
        if ($this->request->data) {
            $data = $this->request->data;
            $mendatoryParameters = array('user_id', "password");
            if ($this->__checkRequestData($mendatoryParameters, $data)) {
                $save_record = false;
                $user_id = urldecode($data["user_id"]);
                $password = $data["password"];
                $split_user_id = explode("_", $user_id);
                if ($split_user_id[1] == 1) {
                    $this->Patients = TableRegistry::get("Patients");
                    $patient = $this->Patients->get($split_user_id[0]);
                    $patient->password = $data["password"];
                    if ($this->Patients->save($patient)) {
                        $save_record = true;
                    } else {
                        $save_record = false;
                    }
                } else if ($split_user_id[1] == 2) {
                    $this->Doctors = TableRegistry::get("Doctors");
                    $doctor = $this->Doctors->get($split_user_id[0]);
                    $doctor->password = $data["password"];
                    if ($this->Doctors->save($doctor)) {
                        $save_record = true;
                    } else {
                        $save_record = false;
                    }
                }
                if ($save_record) {
                    $response['status'] = Configure::read('RESPONSE_SUCCESS_CODE');
                    $response['message'] = "Success";
                } else {
                    $response['status'] = Configure::read('SERVER_ERROR_CODE');
                    $response['message'] = "Please try again after some time!!";
                }
            } else {
                $response['status'] = Configure::read('INSUFFICIENT_PARAMETERS_CODE');
                $response['message'] = Configure::read('INSUFFICIENT_PARAMETERS');
            }
        } else {
            $response['status'] = Configure::read('FORBIDDEN_ERROR_CODE');
            $response['message'] = Configure::read('FORBIDDEN');
        }

        $this->__serialize($response);
    }
	/*
	 * Function Name: __getGUID
	 * Use:  Function use for generating app_token for perticular user
	 * 
	 * 
	 * 
	 * */
    public function __getGUID() {
        mt_srand((double) microtime() * 10000); //optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $uuid = substr($charid, 0, 8)
                . substr($charid, 8, 4)
                . substr($charid, 12, 4)
                . substr($charid, 16, 4)
                . substr($charid, 20, 12)
                . time();

        return strtolower($uuid);
    }
	/*
	 * Function Name: __checkRequestData
	 * Use:  Function use for checking the compulsory request parameter
	 * 
	 * 
	 * 
	 * */
    public function __checkRequestData($requiredfields = array(), $request_data) {
        $flag = 0;
        foreach ($requiredfields as $requiredfield) {
            if (!in_array($requiredfield, array_keys($request_data)) || (!isset($request_data[$requiredfield]))) {
                //debug($requiredfield);
                $flag = 1;
                break;
            }
        }

        if ($flag == 1) {
            return false;
        } else {
            return true;
        }
    }
	/*
	 * Function Name: __checkRequestData
	 * Use:  Function use for serialize the response
	 * 
	 * 
	 * 
	 * */
    public function __serialize($response) {
        if (isset($response['data'])) {
            $this->set(array(
                'status' => $response['status'],
                'message' => $response['message'],
                'data' => $response['data'],
                '_serialize' => array('status', 'message', 'data')
            ));
        } else {
            $this->set(array(
                'status' => $response['status'],
                'message' => $response['message'],
                '_serialize' => array('status', 'message')
            ));
        }
    }
	/*
	 * Function Name: base64upload
	 * Use:  Function use for uploading base64 image
	 * 
	 * 
	 * 
	 * */
    public function base64upload($base64image, $pt_id, $folder_path) {

        //$base64image='';
        //$pt_id=1;

        $folder_path = Configure::read('READING_PATH');
        if (!is_dir($folder_path)) {
            mkdir($folder_path, 0777, true);
        }
        $folder_path = $folder_path . '/' . $pt_id;
        if (!is_dir($folder_path)) {
            mkdir($folder_path, 0777, true);
        }
        $image_parts = explode(";base64,", $base64image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $file_name = md5("_" . date('YmdHis') . "_" . "_" . rand(1, 99999)) . '_' . $pt_id . '.jpg';
        $file = $folder_path . "/" . $file_name;
        if (file_put_contents($file, $image_base64)) {

            return $file_name;
        } else {
            return $file_name = '';
        }
    }
	/*
	 * Function Name: userTimezone
	 * Use:  Function use for getting the currenttimezone of user
	 * 
	 * 
	 * 
	 * */




    public function userTimezone($timeZone) {
        $timezone = new \DateTime();
        $currentTimezone = $timezone->createFromFormat('D M d Y H:i:s e+', $timeZone)->getTimezone()->getName();
        return $currentTimezone;
    }

}
