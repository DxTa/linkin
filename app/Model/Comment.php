<?php
App::uses('AppModel', 'Model');
/**
 * Comment Model
 *
 * @property User $User
 */
class Comment extends AppModel {

/**
 * Display field
 *
 * @var string
 */

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'content' => array(
			'minlength' => array(
				'rule' => array('minlength',2),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
  public $recursive = 2;

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			// 'conditions' => '',
			// 'fields' => '',
			// 'order' => ''
    ),
    'Link' => array(
      'className' => 'Link',
      'foreginKey' => 'link_id'
    )
	);
	public $hasMany = array(
    'Recomment' => array(
      'className' => 'Recomment',
			'foreignKey' => 'comment_id',
			'dependent' => true,
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
