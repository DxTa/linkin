<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 */
class UsersController extends AppController {

  var $defaultSex = array('Undefined' => 'Undefined', 'Male' => 'Male', 'Female' => 'Female', 'Gay' => 'Gay' ,'Lesbian' => 'Lesbian');
  // var $name = 'Users';

  function beforeFilter() {
    parent::beforeFilter();
    Security::setHash('sha1');
    $this->Auth->allow('register');
    $this->Auth->allow('login');
    // $this->Auth->allow('index');
    $this->Auth->allow('verify');
    $this->set('defaultSex', $this->defaultSex);
    // $this->Auth->autoRedirect = false;
  }

  // for facebook
  //Add an email field to be saved along with creation.
  function beforeFacebookSave(){
      $fb_user = $this->Connect->user();

      if ($user = $this->User->findByEmail($fb_user['email'])) {
        return false;
      } else {
        $this->Connect->authUser['User']['email'] = $fb_user['email'];
        $this->Connect->authUser['User']['username'] = $fb_user['username'];
        $this->Connect->authUser['User']['sex'] = $fb_user['gender'];
        $this->Connect->authUser['User']['active'] = true;
        $time = date_parse_from_format('m/d/Y', strtotime($fb_user['birthday']));
        $this->Connect->authUser['User']['dob'] = array('month' => $time["month"],'day' => $time["day"], 'year' => $time["year"]);
        $this->Connect->authUser['User']['avatar'] = FB::api('/me?fields=picture');

        return true; //Must return true or will not save.
      }
      return false;
  }


  function beforeFacebookLogin($user){
    //Logic to happen before a facebook login
  }

  function afterFacebookLogin(){
    //Logic to happen after successful facebook login.
    $this->redirect('/users/index');
  }

  /**
   *  The AuthComponent provides the needed functionality
   *  for login, so you can leave this function blank.
   */
  function login() {
    if ($this->Auth->User())
      $this->redirect($this->referer());

    if ($this->request->is('post')) {
      if ($this->Auth->login()) {
        $this->redirect($this->Auth->redirect());
      } else {
        $this->Session->setFlash(__('Invalid username or password, try again'));
      }
    }
  }

  function logout() {
    $this->Session->destroy();
    $this->redirect($this->Auth->logout());
  }

  function register() {
    if ($this->Auth->User())
      $this->redirect($this->referer());
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

  function view($id = null) {
    if (!$id) {
      throw new NotFoundException(__('Invalid user'));
    }

    $user = $this->User->findById($id);
    if (!$user) {
      throw new NotFoundException(__('Invalid user'));
    }
    $this->set('user', $user);
  }

  function edit($id = null) {
    if (!$id) {
      throw new NotFoundException(__('Invalid user'));
    }

    $user = $this->User->findById($id);
    if (!$user || $user["User"]["id"] != $this->Auth->user('id')) { //check if current_user
      $this->Session->setFlash('Unable to update this profile.');
      $this->redirect($this->referer());
    }

    if ($this->request->is('post') || $this->request->is('put')) {
      $this->User->id = $id;
      if ($this->User->save($this->request->data)) {
        $this->Session->setFlash('User has been updated.');
        $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash('Unable to update your profile.');
      }
    }

    if (!$this->request->data) {
      $this->request->data = $user;
    }
  }

  function delete($id) {
    // check if admin
    if ($this->Auth->User('admin') == false) {
      $this->Session->setFlash('Only admin can delete.');
      $this->redirect($this->referer());
    }

    if ($this->request->is('get')) {
      throw new MethodNotAllowedException();
    }

    if ($this->User->delete($id)) {
      $this->Session->setFlash('The user with id: ' . $id . ' has been deleted.');
      $this->redirect(array('action' => 'index'));
    }
  }

  function share() {
    $this->Facebook->share('http://vnexpress.net');
  }

}
