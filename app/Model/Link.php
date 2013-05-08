<?php
App::uses('AppModel', 'Model');
define('UPLOAD_DIR_LINK', WWW_ROOT . 'uploads/links');
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
  public $recursive = 3;

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
        'uploadDir' => UPLOAD_DIR_LINK,
        'finalPath' => '/app/webroot/uploads/links/',
        'dbColumn' => 'image',
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
		'url' => array(
      'minlength' => array(
        'rule' => array('minlength',3),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
      ),
		),
		'description' => array(
			'minlength' => array(
				'rule' => array('minlength',6),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
    // 'category_id' => array(
        // 'required' => true,
        // 'message' => 'Select one category',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
		// ),
		'message' => array(
			'maxlength' => array(
				'rule' => array('maxlength',100),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
      ),
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Owner' => array(
			'className' => 'User',
			'foreignKey' => 'owner_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
    'Category' => array(
      'className' => 'Category',
      'foreignKey' => 'category_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
    ),
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
    ),
    'Comment' => array(
      'className' => 'Comment',
      'foreignKey' => 'link_id',
      'dependent' => true,
      'conditions' => '',
      'fields' => '',
      'order' => 'created_at',
      'limit' => '',
      'offset' => '',
      'exclusive' => '',
      'finderQuery' => '',
      'counterQuery' => ''
    )
  );

  public $hasAndBelongsToMany = array(
    'likedUsers' => array(
      'className' => 'User',
      'joinTable' => 'user_link_likes',
      'foreignKey' => 'user_id',
      'associationForeignKey' => 'link_id',
      'unique' => true,
    ),
  );

}
