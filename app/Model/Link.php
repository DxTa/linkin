<?php
App::uses('AppModel', 'Model');
define('UPLOAD_DIR', WWW_ROOT . 'uploads/links');
/**
 * Link Model
 *
 * @property Owner $Owner
 * @property Image $Image
 * @property Like $Like
 * @property View $View
 */
class Link extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

/**
 * Validation rules
 *
 * @var array
 */

  public $actsAs = array(
    'Uploader.Attachment' => array(
      'image' => array(
        'nameCallback' => '',
        'append' => '',
        'prepend' => '',
        'uploadDir' => UPLOAD_DIR,
        'finalPath' => '/app/webroot/uploads/links',
        'dbColumn' => 'images',
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
	public $validate = array(
		'title' => array(
			'minlength' => array(
				'rule' => array('minlength'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'description' => array(
			'minlength' => array(
				'rule' => array('minlength'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Owner' => array(
			'className' => 'Owner',
			'foreignKey' => 'owner_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Image' => array(
			'className' => 'Image',
			'foreignKey' => 'image_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'UserLinkLike' => array(
			'className' => 'UserLinkLike',
			'foreignKey' => 'link_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'UserLinkView' => array(
			'className' => 'UserLinkView',
			'foreignKey' => 'link_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
