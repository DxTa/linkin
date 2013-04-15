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

  public function make() {
    if($this->request->is('post')) {
      $this->Link->create();
      if($this->Link->save($this->request->data)) {

      } else {

      }
    }
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
    $this->set('links', $this->Link->find('all'));
  }


}
