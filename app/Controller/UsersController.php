<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 */
class UsersController extends AppController {

  public $helpers = array('Html', 'Form');
  // var $name = 'Users';

  function beforeFilter() {
    // parent::beforeFilter();
    Security::setHash('sha1');
    $this->Auth->allow('delete');
    $this->Auth->allow('register');
    $this->Auth->allow('login');
    $this->Auth->allow('index');
    $this->Auth->allow('verify');
    // $this->Auth->autoRedirect = false;
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

        $last = $this->User->read(null,$this->User->id);

        $Email = new CakeEmail('gmail');
        $Email->template('verify_email')
          ->emailFormat('html')
          ->viewVars(array('remember_token' => $last["User"]["remember_token"]))
          ->to($last["User"]['email'])
          ->subject('[Linkin] Verify your email!')
          ->send();

        $this->Session->setFlash(__('The user has been saved. Please verify your email.'));
        $this->redirect(array('action' => 'login'));
      } else {
        $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
      }
    }
  }

  function verify() {
    $user = $this->User->findByRememberToken($this->request->query['remember_token']);
    if ($user) {
      $this->User->id = $user["User"]["id"];
      $this->User->saveField('active',true);
      $this->Session->setFlash(__('The user has been verified'));
    }
    else {
      $this->Session->setFlash(__('This link does not exist!'));
    }
  }

  function home() {

  }

  function index() {
    $this->set('users', $this->User->find('all'));
  }
}
