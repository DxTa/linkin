<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Authentication $Authentication
 * @property Comment $Comment
 * @property Friendship $Friendship
 * @property Like $Like
 * @property View $View
 * @property User $Friends
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'email';
	public $primary_key = 'user_id';
	public $sequence = 'core_user_id_seq';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'username' => array(
			'minlength' => array(
				'rule' => array('minlength',2),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
      'required' => array(
        'rule' => array('notEmpty'),
        'message' => 'A username is required'
      ),
    ),
    'password' => array(
      'required' => array(
          'rule' => array('notEmpty'),
          'message' => 'A password is required'
      )
    ),
  );


  public function beforeSave($options = array()) {
    if (isset($this->data[$this->alias]['password'])) {
      $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
    }
    return true;
  }

  //The Associations below have been created with all possible keys, those that are not needed can be removed

  /**
   * belongsTo associations
   *
   * @var array
   */
  public $belongsTo = array(
    'Image' => array(
      'className' => 'Image',
      'foreignKey' => 'avatar',
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
    'Authentication' => array(
      'className' => 'Authentication',
      'foreignKey' => 'user_id',
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
      'foreignKey' => 'user_id',
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
    'Like' => array(
      'className' => 'Like',
      'foreignKey' => 'user_id',
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
    'View' => array(
      'className' => 'View',
      'foreignKey' => 'user_id',
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


  /**
   * hasAndBelongsToMany associations
   *
   * @var array
   */
  public $hasAndBelongsToMany = array(
    'followingFriends' => array(
      'className' => 'User',
      'joinTable' => 'friendships',
      'foreignKey' => 'user_id',
      'associationForeignKey' => 'friend_id',
      'unique' => 'keepExisting',
      'conditions' => '',
      'fields' => '',
      'order' => '',
      'limit' => '',
      'offset' => '',
      'finderQuery' => '',
      'deleteQuery' => '',
      'insertQuery' => ''
    ),
    'followedFriends' => array(
      'className' => 'User',
      'joinTable' => 'friendships',
      'foreignKey' => 'friend_id',
      'associationForeignKey' => 'user_id',
      'unique' => 'keepExisting',
      'conditions' => '',
      'fields' => '',
      'order' => '',
      'limit' => '',
      'offset' => '',
      'finderQuery' => '',
      'deleteQuery' => '',
      'insertQuery' => ''
    )
  );

}
