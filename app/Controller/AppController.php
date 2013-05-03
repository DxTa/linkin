<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
  public $helpers = array('Facebook.Facebook','Html','Form');
  public $components = array(
    'Session',
    'Auth' => array(
      // 'authorize' => array('Controller'), // <- here
      'loginRedirect' => array('controller' => 'users', 'action' => 'home'),
      'logoutRedirect' => array('controller' => 'users', 'action' => 'login')
    ),
    'Facebook.Connect' => array('model' => 'User', 'noAuth' => true),
    'DebugKit.Toolbar'
  );

  public function beforeFilter() {
    // if ($this->Auth->User() != null && $this->Auth->User()['active'] == false) {
      // $this->Session->setFlash('Account need to be verified.');
      // $this->redirect($this->Auth->logout());
    // }
    $this->loadModel('User');
    $this->loadModel('Category');
    $this->set('current_user', $this->User->findByEmail($this->Auth->User('email')));
    $this->set('channels',$this->Category->find('all',array()));
  }

  // public function isAuthorized($user) {
    // return $user['active'];
  // }

}
