<?php
App::uses('AppController', 'Controller');
/**
 * Views Controller
 *
 */
class UserLinkSendsController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;

  public function make() {

    $this->layout = 'ajax';
    $this->autoLayout = false;
    $this->autoRender = false;
    $response = array('success' => true);
    if($this->request->is('post')) {
      $this->UserLinkSend->create();
      if($this->UserLinkSend->save($this->request->data)) {
      } else {
        $response['success'] = false;
      }
    }
    $this->header('Content-Type: application/json');
    echo json_encode($response);
    return;
  }

}
