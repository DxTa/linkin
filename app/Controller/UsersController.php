<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 */
class UsersController extends AppController {

  var $name = 'Users';

  function beforeFilter() {
    $this->Auth->fields = array(
      'username' => 'username',
      'password' => 'secretword'
    );
    $this->Auth->allow('delete');
    $this->Auth->allow('register');
  }

  function isAuthorized() {
    if ($this->Auth->user('admin') != true) {
      $this->Auth->deny('delete');
    }
  }

  /**
   *  The AuthComponent provides the needed functionality
   *  for login, so you can leave this function blank.
   */
  function login() {
  }

  function logout() {
    $this->redirect($this->Auth->logout());
  }

  function register() {
    if(!empty($this->data)) {
      $this->User->create();
      // $assigned_password = 'password';
      // $this->data['User']['password'] = $assigned_password;
      if($this->User->save($this->data)) {
        // send signup email containing password to the user
        $this->Auth->login($this->data);
        $this->redirect('home');
      }
    }
  }

  function home() {

  }
}
