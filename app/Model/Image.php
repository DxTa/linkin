<?php
App::uses('AppModel', 'Model');
/**
 * Image Model
 *
 */
class Image extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'url';

  public $actsAs = array(
    'Uploader.Attachment' => array(
      'file' => array(
        'nameCallback' => '',
        'append' => '',
        'prepend' => '',
        'uploadDir' => 'app/webroot/uploads/images',
        'finalPath' => '',
        'dbColumn' => 'path',
        'metaColumns' => array(),
        'defaultPath' => '',
        'overwrite' => false,
        'stopSave' => false,
        'allowEmpty' => true,
      )
    ),
    'Uploader.FileValidation' => array(
      'fileName' => array(
        'extension' => array('gif', 'jpg', 'png', 'jpeg'),
        'required'  => true
      )
    )
  );

}
