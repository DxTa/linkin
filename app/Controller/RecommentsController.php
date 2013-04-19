<?php
App::uses('AppController', 'Controller');
/**
 * Comments Controller
 *
 */
class RecommentsController extends AppController {

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

      $this->Recomment->create();
      if($this->Recomment->save($this->request->data)) {
        $this->loadModel('Link');
        $this->loadModel('Comment');

        $comment = $this->Comment->findById($this->request->data['Recomment']['comment_id']);
        $link = $this->Comment->findById($comment['Comment']['id']);
        $this->Link->id = $link['Link']['id'];
        $this->Link->saveField('cnt_comments',$link['Link']['cnt_comments'] + 1);

      } else {
        $response['success'] = false;
      }
      $this->header('Content-Type: application/json');
      echo json_encode($response);
      return;
    }

  }
}
