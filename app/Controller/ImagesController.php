<?php
App::uses('AppController', 'Controller');
/**
 * Images Controller
 *
 */
class ImagesController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */
  function upload() {
    if ($this->request->is('post')) {
      if ($this->Image->save($this->request->data, true)) {
        $this->Session->setFlash('Your HEHE has been saved.');
        // Do something
      }
      else {

      }
   }
  }
}
