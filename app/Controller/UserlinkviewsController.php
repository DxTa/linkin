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
    $this->loadModel('Link');
    $link = $this->Link->findById($this->request->data['UserLinkView']['link_id']);
    $this->Link->id = $this->request->data['UserLinkView']['link_id'];
    $this->Link->saveField('cnt_views',$link['Link']['cnt_views'] + 1);

    $this->layout = 'ajax';
    $this->autoLayout = false;
    $this->autoRender = false;
    if($this->request->is('post')) {
      $this->UserLinkView->create();
      if($this->UserLinkView->save($this->request->data)) {

      } else {

      }
    }
  }

}
