<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Core\Configure;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize() {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Cookie');
        $authUser = false;

        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'email']
                ]
            ],
            'loginRedirect' => [
                'controller' => 'Dashboards',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ]
        ]);
        $authUser = true;
        $this->current_user = $this->Auth->user();

        $session = $this->request->session();
        /* debug($_COOKIE["currentTimezone"]);
          exit; */
        if (isset($_COOKIE['currentTimezone']) && !isset($this->current_user)) {
            //debug($_COOKIE["currentTimezone"]);
            //exit;
            $this->is_admin = false;
            $timezone = new \DateTime();
            $this->currentTimezone = $timezone->createFromFormat('D M d Y H:i:s e+', $_COOKIE['currentTimezone'])->getTimezone()->getName();

            $session->write('currentTimezone', $this->currentTimezone);
            $this->set('currentTimezone', $this->currentTimezone);
        } else {
            if ($authUser) {
                $this->is_admin = ($this->Auth->user('role_id') < 3) ? true : false;
                $this->current_user['full_name'] = $this->current_user['firstname'] . ' ' . $this->current_user['lastname'];
            }

            if (!isset($_COOKIE['currentTimezone'])) {
                $this->currentTimezone = 'UTC';
                $session->write('currentTimezone', $this->currentTimezone);
                $this->set('currentTimezone', $this->currentTimezone);
            } else {
                $this->currentTimezone = $session->read('currentTimezone');
                $this->set('currentTimezone', $this->currentTimezone);
            }
        }
        if ($authUser) {
            $this->set('current_user', $this->current_user);
            $this->set('is_admin', $this->is_admin);
        }
        //$session->write('Config.language', 'fr');
        $this->set('theme', Configure::read('Theme'));

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event) {
        if (!array_key_exists('_serialize', $this->viewVars) &&
                in_array($this->response->type(), ['application/json', 'application/xml'    ])
        ) {
            $this->set('_serialize', true);
        }
		$this->setCorsHeaders();
                 if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_METHOD"]))
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT"); //Make sure you remove those you do not want to support

    if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_HEADERS"]))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    }
	
	private function setCorsHeaders() {
    $this->response->cors($this->request)
        ->allowOrigin(['*'])
        ->allowMethods(['*'])
        ->allowHeaders(['x-xsrf-token', 'Origin', 'Content-Type', 'X-Auth-Token','app_token'])
        ->allowCredentials(['true'])
        ->exposeHeaders(['Link'])
        ->maxAge(1728000)
        ->build();
}

}
