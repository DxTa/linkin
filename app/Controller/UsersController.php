<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 */
class UsersController extends AppController {

  var $name = 'Users';

  function beforeFilter() {
    parent::beforeFilter();
    Security::setHash('md5');
    $this->Auth->allow('delete');
    $this->Auth->allow('register');
    $this->Auth->allow('login');
    // $this->Auth->autoRedirect = false;
  }

  function isAuthorized() {
    if ($this->Auth->user('admin') != true) {
      $this->Auth->deny('delete');
    }
  }

  public function beforeSave() {
    if (isset($this->data[$this->alias]['password'])) {
      $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
    }
    return true;
  }

  /**
   *  The AuthComponent provides the needed functionality
   *  for login, so you can leave this function blank.
   */
  function login() {
    if ($this->request->is('post')) {
      if ($this->Auth->login()) {
        $this->redirect($this->Auth->redirect());
      } else {
        $this->Session->setFlash(__('Invalid username or password, try again'));
      }
    }
  }

  function logout() {
    $this->redirect($this->Auth->logout());
  }

  function register() {
    if ($this->request->is('post')) {
      $this->User->create();
      if ($this->User->save($this->request->data)) {
        $this->Session->setFlash(__('The user has been saved'));
        $this->redirect(array('action' => 'login'));
      } else {
        $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
      }
    }
  }

  function home() {

  }
}
