<?php
App::uses('AppController', 'Controller');

/**
 * Categories Controller
 *
 */
class SearchesController extends AppController {

  var $uses = false;
  function beforeFilter() {
    parent::beforeFilter();
    Security::setHash('sha1');
    $this->Auth->allow('search');
  }

  public function search()  {

    $this->loadModel('Link');
    $keyword = $this->request->data['Search']['keyword'];
    $this->set('links',$this->Link->find('all',array(
        'conditions' => array('Link.description LIKE ' =>"%".$keyword."%"),
        'order' => array('Link.cnt_likes DESC'),
      )));
  }
}
