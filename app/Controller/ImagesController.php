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
  public $actsAs = array(
    'Uploader.Attachment' => array(
      'url' => array(
        'nameCallback' => '',
        'append' => '',
        'prepend' => '',
        'tempDir' => TMP,
        'uploadDir' => '/img/images/',
        'finalPath' => '',
        'dbColumn' => 'url_path',
        'metaColumns' => array(),
        'defaultPath' => '',
        'overwrite' => false,
        'stopSave' => true,
        'allowEmpty' => true,
        'transforms' => array(),
        'transport' => array()
      )
    ),
    'Uploader.FileValidation' => array(
      'fileName' => array(
        'extension' => array('gif', 'jpg', 'png', 'jpeg'),
        'required'  => true
      )
    )
  );

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
