<?php
App::uses('AppController', 'Controller');
/**
 * Comments Controller
 *
 */
class CommentsController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;


  public function make() {
    if($this->request->is('post')) {

      $this->layout = 'ajax'; // Or $this->RequestHandler->ajaxLayout, Only use for HTML
      $this->autoLayout = false;
      $this->autoRender = false;
      $response = array('success' => true);

      $this->Comment->create();
      if($this->Comment->save($this->request->data)) {

      } else {
        $response['success'] = false;
      }
      $this->header('Content-Type: application/json');
      echo json_encode($response);
      return;
    }

  }

}
