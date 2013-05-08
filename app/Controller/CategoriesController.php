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
    if (!$category) {
      throw new NotFoundException(__('Invalid link'));
    }
    $this->loadModel('Link');
    $this->set('category', $category);
    $this->set('top_links',$this->Link->find('all',array(
        'order' => array('Link.cnt_likes DESC'),
        'limit' => 10,
        'recursive' => -1
      )));
  }

  public function index() {
    $this->set('categories', $this->Category->find('all',array()));

  }


}
