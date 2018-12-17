<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Utility\Hash;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class DashboardsController extends AppController {

    public function initialize() {
        parent::initialize();
        //$this->Auth->allow(['login']);
        $this->viewBuilder()->layout('Admin.default');
    }

    public function index() {
        
    }

}
