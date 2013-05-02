<?php
App::uses('AppController', 'Controller');

/**
 * Categories Controller
 *
 */
class CategoriesController extends AppController {

  var $helpers = array('Html', 'Form', 'Js'=>array("Jquery"));

  function beforeFilter() {
    parent::beforeFilter();
    Security::setHash('sha1');
    $this->Auth->allow('index');
    $this->Auth->allow('view');
  }

  public function view($id = null)  {
    if (!$id) {
      throw new NotFoundException(__('Invalid link'));
    }

    $category = $this->Category->findById($id);
    if (!$link) {
      throw new NotFoundException(__('Invalid link'));
    }
    $this->set('category', $category);
  }

  public function index() {
    $this->set('categories', $this->Category->find('all',array()));
  }


}
