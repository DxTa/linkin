<?php
App::uses('AppController', 'Controller');

/**
 * Links Controller
 *
 */
class LinksController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;

  var $helpers = array('Html', 'Form', 'Js'=>array("Jquery"));


  function beforeFilter() {
    parent::beforeFilter();
    Security::setHash('sha1');
    $this->Auth->allow('index');
  }

  public function make() {
    if($this->request->is('post')) {
      $this->Link->create();
      $this->request->data['Link']['owner_id'] = $this->Auth->user('id');
      if($this->Link->save($this->request->data)) {
        if($this->request->is('ajax')) {
          $this->layout = 'ajax'; // Or $this->RequestHandler->ajaxLayout, Only use for HTML
          $this->autoLayout = false;
          $this->autoRender = false;
          $response = array('success' => true);
          $data = array('redirectURL' => "/links/view/{$this->Link->id}");
          $response['data'] = $data;
          $this->header('Content-Type: application/json');
          echo json_encode($response);
        } else {
          $this->redirect($this->request->data['Link']['url']);
        }
      } else {

      }
    }
  }

  public function view($id = null)  {
    if (!$id) {
      throw new NotFoundException(__('Invalid link'));
    }

    $link = $this->Link->findById($id);
    if (!$link) {
      throw new NotFoundException(__('Invalid link'));
    }
    $this->set('link', $link);
  }

  public function loadImg() {
    $this->layout = 'ajax'; // Or $this->RequestHandler->ajaxLayout, Only use for HTML
    $this->autoLayout = false;
    $this->autoRender = false;

    $url = $this->request->data;

    $response = array('success' => true);
    $i = 0;
    $data = array();
    $html = file_get_html($url);
    foreach($html->find('img') as $element) {
      array_push($data,url_to_absolute($url, $element->src));
    }
    $response['data'] = $data;


    $this->header('Content-Type: application/json');
    echo json_encode($response);
    return;
  }

  public function index() {
    $this->set('links', $this->Link->find('all',array(
      'conditions' => array('Link.cnt_likes >=' => 5),
      'order' => array('Link.updated_at DESC','Link.cnt_likes DESC')
    )));
    $this->set('top_links',$this->Link->find('all',array(
      'order' => array('Link.cnt_likes DESC'),
      'limit' => 10
    )));
  }

  public function news() {
    $this->set('links', $this->Link->find('all',array(
      'order' => array('Link.updated_at DESC')
    )));
    $this->set('top_links',$this->Link->find('all',array(
      'order' => array('Link.cnt_likes DESC'),
      'limit' => 10
    )));

  }


}
