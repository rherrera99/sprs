<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use Cake\Mailer\Email;
use Cake\Routing\Router;


/**
 * Common Controller
 *
 */
class CommonController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->Auth->allow();
    }

    public static function convertToUserTimeZone($datetime) {
        $timeZone = $_SESSION["currentTimezone"];
        $userDate = new \DateTime($datetime, new \DateTimeZone('UTC'));
        $userDate->setTimeZone(new \DateTimeZone($timeZone));
        return $userDate->format("d-M-Y h:i A");
    }

    public static function convertToGMT($datetime) {
        $timeZone = $_SESSION["currentTimezone"];
        $serverDate = new \DateTime($datetime, new \DateTimeZone($timeZone));
        $serverDate->setTimeZone(new \DateTimeZone('UTC'));
        return $serverDate->format("Y-m-d H:i:s");
    }
    
    public static function convertToUserTimeZoneFront($datetime,$timezone) {
     
        $userDate = new \DateTime($datetime, new \DateTimeZone('UTC'));
        $userDate->setTimeZone(new \DateTimeZone($timezone));
        return $userDate->format("d-M-Y h:i A");
    }

    public static function convertToGMTFront($datetime,$timezone) {
        
        $serverDate = new \DateTime($datetime, new \DateTimeZone($timezone));
        $serverDate->setTimeZone(new \DateTimeZone('UTC'));
        return $serverDate->format("Y-m-d H:i:s");
    }

    public static function sendRegisterMailToCustomer($email, $fullname, $admin, $password, $drId) {

        $doctors = TableRegistry::get('Doctors');
        $doctor = $doctors->find()->where(["id" => $drId])->toArray();

        $doctor_name = $doctor[0]->first_name . " " . $doctor[0]->last_name;

        $subject = "Register With Invite!!";
        $message = "Hello $fullname from SPRS,<br/>
                        You will be invited by the Dr.$doctor_name
                       You can now log in with blow username and password.<br/>
                       UserName : $email  <br/>
                       Password   : $password <br/>
                       ";
        
//$this->getSetTemplate("customer_accountcreation", $fullname, $email, "", "", "");
        self::sendMail([$email], $subject, $message,$admin);
    }
	/*
	 * Function Name: sendMail
	 * Use:  Common function send mail
	 * 
	 * 
	 * 
	 * */
    public static function sendMail($arrayTo, $subject = '(No subject)', $message = '', $user = null, $attachments = null) {

        $fromName = Configure::read("EmailConfig");
        $from_email = "hello@trioloc.com";
        $from_user = isset($user) ? $user["firstname"] . " " . $user["lastname"] : $fromName["from-name"];
        $email = new Email('default');
        $email->from([$from_email => $from_user]);
        //debug();
        //exit;
        foreach ($arrayTo as $to) {
            $email->addTo($to);
        }
        if ($attachments) {
            $email->addAttachments($attachments);
        }
        $mail = $email->subject($subject)
                ->emailformat('html')
                ->send($message);
        return $mail;
    }
	/*
	 * Function Name: uploadImages
	 * Use:  We can not use this function now
	 * 
	 * 
	 * 
	 * */
	
    public static function uploadImages($file, $name, $folderUrl) {
        // setup dir names absolute and relative
        $folder_url = $folderUrl;
        //$folder_url = ROOT . DS . "src" . DS . "uploads";
        $rel_url = $folder_url;

        // create the folder if it does not exist
        if (!is_dir($folder_url)) {
            mkdir($folder_url, 0777, true);
        }

        // list of permitted file types, this is only images but documents can be added
        // loop through and deal with the files
        //foreach ($formdata as $file) {
        // replace spaces with underscores
        $filename = str_replace(' ', '_', $file['name']);
        // assume filetype is false
        $typeOK = true;
        // check filetype is ok
        // if file type ok upload the file
        if ($typeOK) {
            // switch based on error code
            // create unique filename and upload file
            //ini_set('date.timezone', 'Europe/London');

            $ext = AppUtil::FileExt($file['type']);
            $now = date('Y-m-d-H:i:s');

            $filename = md5("_" . $now . "_" . "_" . $name . rand(1, 99999)) . $ext;

            $full_url = $folder_url . '/' . $filename;
            //debug($full_url);   
            $url = $rel_url . '/' . $filename;
            //debug($url);
            //exit;   
            $success = move_uploaded_file($file['tmp_name'], $url);
            //debug($success);
            // if upload was successful
            if ($success) {
                // save the url of the file  
                $result["status"] = true;
                $result['url'] = $filename;
            } else {
                $result["status"] = false;
                $result['error'] = "Error uploaded $filename. Please try again.";
            }
        } elseif ($file['error'] == 4) {
            // no file was selected for upload
            $result["status"] = false;
            $result['error'] = "No file Selected";
        } else {
            // unacceptable file type
            $result["status"] = false;
            $result['error'] = "$filename cannot be uploaded. Acceptable file types: gif, jpg, png.";
        }
        // }
        return $result;
    }

//    private function sendMail($to, $from_user, $from_email, $subject = '(No subject)', $message = '') {
//        $isSendMail = Configure::read("SendMail");
//       
//            $email = new Email('default');
//            $email->from([$from_email => $from_user])
//                    ->to($to)
//                    ->subject($subject)
//                    ->emailformat('html')
//                    ->send($message);
//        
//    }
//     public static function commonFunctionForMail($userEmail, $fullName, $admin) {
//
//        if ($userEmail) {
////            if ($category == 1) {
////                $message = RentController::mailDomForBooking($orders, $payStatus);
////                $subject = "Rentsy Invoice #" . $orders["id"];
////            } elseif ($category == 2) {
////                $message = RentController::mailDomForCancellation();
////                $subject = "Booking Cancellation";
////            }
//            
//            $message = "hello $fullName";
//            $subject = "for conformation";
//            $arrayTo = [$userEmail];
//            $toName = $fullName . ", ";
//            $fromName = Configure::read("EmailConfig");
//            $from_user = isset($admin) ? $admin["fullName"] . " " . $admin["fullName"] : $fromName["from-name"];
////debug($arrayTo);
//            return RentController::sendMail($arrayTo, $subject, $message, $admin);
//        }
//    } 
    public function sendRegisterMailToAdmin($email, $fullname, $admin) {

        $fromName = Configure::read("EmailConfig");
        $from_user = isset($admin) ? $admin[0]["full_name"] : $fromName["from-name"];
        $from_mail = isset($admin) ? $admin[0]["email"] : $fromName["from-email"];
        $subject = "Registration Request!!";
        // $editurl = Configure::read("EmailTemplate")["shop_admin_url"] . "/users/edit/" . $id;
        $message = "hello Rentsy Admin. <br/> Please Activate the $fullname as per there Requset. ";
//$this->getSetTemplate("admin_accountcreation", $fullname, $email, "", $editurl, "");
        $varable = $this->sendMail($email, $from_user, $from_mail, $subject, $message);
    }

    public function sendApprovelMailToCustomer($email, $fullname, $admin, $password) {
        $fromName = Configure::read("EmailConfig");

        $from_user = isset($admin) ? $admin[0]["full_name"] : $fromName["from-name"];
        $from_mail = isset($admin) ? $admin[0]["email"] : $fromName["from-email"];
        $subject = "Registration Request!!";
        $message = "hello $fullname from Rentsy,<br/> Congratulations! You'r request is successfully registred. Your password is: $password ";
//$this->getSetTemplate("customer_accountcreation", $fullname, $email, "", "", "");
        $this->sendMail($email, $from_user, $from_mail, $subject, $message);
    }

    public function sendForgetpwdMailToBusiness($email, $fullname, $admin, $uid) {
        $fromName = Configure::read("EmailConfig");

        $from_user = isset($admin) ? $admin[0]["full_name"] : $fromName["from-name"];
        $from_mail = isset($admin) ? $admin[0]["email"] : $fromName["from-email"];
        $subject = "Reset your password";
        $message = "hello $fullname from Rentsy,<br/> Please Click on above link for reset password <br/> <a href='" . SITE_URL . Router::url(['controller' => 'Users', 'action' => 'resetPassword', $uid]) . "'>" . SITE_URL . Router::url(['controller' => 'Users', 'action' => 'resetPassword', $uid]) . "</a>";
//$this->getSetTemplate("customer_accountcreation", $fullname, $email, "", "", "");
        $this->sendMail($email, $from_user, $from_mail, $subject, $message);
    }

    public function sendForgetpwdMailToCustomer($email, $fullname, $admin, $uid) {
        $fromName = Configure::read("EmailConfig");

        $from_user = isset($admin) ? $admin[0]["full_name"] : $fromName["from-name"];
        $from_mail = isset($admin) ? $admin[0]["email"] : $fromName["from-email"];
        $subject = "Reset your password";
        $message = "hello $fullname from Rentsy,<br/> Please Click on above link for reset password <br/> <a href='" . SITE_URL . Router::url(['prefix' => 'admin', 'controller' => 'Customers', 'action' => 'resetPassword', $uid]) . "'>" . SITE_URL . Router::url(['prefix' => 'admin', 'controller' => 'Customers', 'action' => 'resetPassword', $uid]) . "</a>";
//$this->getSetTemplate("customer_accountcreation", $fullname, $email, "", "", "");
        $this->sendMail($email, $from_user, $from_mail, $subject, $message);
        return true;
    }
    
    
    
    
    public static function sendForgotPasswordToCustomer($email, $fullname, $admin, $pt_id, $drId) {
        /*$email="sshah4892@gmail.com";
        $fullname="Sneh Shah";
        $admin=["firstname"=>"admin","lastname"=>"admin","email"=>"snehshah@menloparkworld.com"];
        $pt_id=1;*/
        if ($pt_id) {
            $link = FRONT_URLP.urlencode($pt_id."_1");
        } else if($drId){
            $link = FRONT_URLD.urlencode($drId."_2");
        }
        $subject = "Reset password email";
        $message = "Hello $fullname,<br/>
                        Please click link for reset password : ".$link;

//$this->getSetTemplate("customer_accountcreation", $fullname, $email, "", "", "");
        self::sendMail([$email], $subject, $message, $admin);
        
    }

}

?>