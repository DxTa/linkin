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
  var $helpers = array('Html', 'Form', 'Js'=>array("Jquery"));


  public function make() {
    if($this->request->is('post')) {

      $this->layout = 'ajax'; // Or $this->RequestHandler->ajaxLayout, Only use for HTML
      $this->autoLayout = false;
      $this->autoRender = false;
      $response = array('success' => true);

      $this->Comment->create();
      if($this->Comment->save($this->request->data)) {
        $this->loadModel('Link');
        $link = $this->Link->findById($this->request->data['Comment']['link_id']);
        $this->Link->id = $this->request->data['Comment']['link_id'];
        $this->Link->saveField('cnt_comments',$link['Link']['cnt_comments'] + 1);
        $comment = $this->Comment->findById($this->Comment->id);
        $view = new View($this, false);
        $response['data'] =  $view->element('comment/comment-block', array('comment' => $comment, 'current_user' => $this->User->findByEmail($this->Auth->User('email'))));
      } else {
        $response['success'] = false;
      }
      $this->header('Content-Type: application/json');
      echo json_encode($response);
      return;
    }

  }

  public function view($id = null)  {
    if (!$id) {
      throw new NotFoundException(__('Invalid link'));
    }

    $comment = $this->Comment->findById($id);
    if (!$comment) {
      throw new NotFoundException(__('Invalid link'));
    }
    $this->set('comment', $comment);
  }
}
