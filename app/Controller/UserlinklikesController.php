<?php
App::uses('AppController', 'Controller');
/**
 * Likes Controller
 *
 */
class UserLinkLikesController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;

  public function make() {
    $this->loadModel('Link');
    $link = $this->Link->findById($this->request->data['UserLinkLike']['link_id']);
    $this->Link->id = $this->request->data['UserLinkLike']['link_id'];
    $this->Link->saveField('cnt_likes',$link['Link']['cnt_likes'] + 1);
    $this->layout = 'ajax';
    $this->autoLayout = false;
    $this->autoRender = false;
    if($this->request->is('post')) {
      $this->UserLinkLike->create();
      if($this->UserLinkLike->save($this->request->data)) {

      } else {

      }
    }
  }
}
