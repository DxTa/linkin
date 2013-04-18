<?php
App::uses('AppController', 'Controller');
/**
 * Views Controller
 *
 */
class UserLinkViewsController extends AppController {

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
      $this->UserLinkView->create();
      if($this->UserLinkView->save($this->request->data)) {
        $this->loadModel('Link');
        $link = $this->Link->findById($this->request->data['UserLinkView']['link_id']);
        $this->Link->id = $this->request->data['UserLinkView']['link_id'];
        $this->Link->saveField('cnt_views',$link['Link']['cnt_views'] + 1);
      } else {
        $response['success'] = false;
      }
    }
    $this->header('Content-Type: application/json');
    echo json_encode($response);
    return;
  }

}
