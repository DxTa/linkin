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
	// public $displayField = 'email';
	// public $primary_key = 'user_id';
	// public $sequence = 'core_user_id_seq';

/**
 * Validation rules
 *
 * @var array
 */
  public $actsAs = array(
    'Uploader.Attachment' => array(
      'avatar' => array(
        'nameCallback' => '',
        'append' => '',
        'prepend' => '',
        'uploadDir' => 'app/webroot/uploads/users',
        'finalPath' => '',
        'dbColumn' => 'avatar',
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
    'email' => array(
      'email' => array(
        'rule' => array('email'),
        //'message' => 'Your custom message here',
        //'allowEmpty' => false,
        //'required' => false,
        //'last' => false, // Stop validation after this rule
        //'on' => 'create', // Limit validation to 'create' or 'update' operations
      ),
      'required' => array(
        'rule' => array('notEmpty'),
        'message' => 'An email is required'
      ),
      'unique' => array(
        'rule' => 'isUnique',
        'required' => 'create'
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
      'unique' => array(
        'rule' => 'isUnique',
        'required' => 'create'
      ),
    ),
    'password' => array(
      'required' => array(
        'rule' => array('notEmpty'),
        'message' => 'A password is required'
      )
    ),
    'sex' => array(
      'required' => array(
          'rule' => '/^gay|lesbian|male|female|undefined$/i',
          'message' => 'Your sex must be male,female,lesbian,gay,undefined'
      )
    ),
  );


  public function beforeSave($options = array()) {
    if (isset($this->data[$this->alias]['password'])) {
      $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
    }
    if (!$this->id && !isset($this->data[$this->alias][$this->primaryKey])) {
      // beforeSave when create new record
      // generate sha1 token to verify email
      $this->data[$this->alias]['remember_token'] = sha1($this->data["User"]["username"].rand(0,100));
    }
    else {
      // beforeSave when update a record
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
      'dependent' => true,
      // 'conditions' => '',
      // 'fields' => '',
      // 'order' => '',
      // 'limit' => '',
      // 'offset' => '',
      // 'exclusive' => '',
      // 'finderQuery' => '',
      // 'counterQuery' => ''
    ),
    'Comment' => array(
      'className' => 'Comment',
      'foreignKey' => 'user_id',
      'dependent' => true,
      // 'conditions' => '',
      // 'fields' => '',
      'order' => 'Comment.created_at DESC',
      // 'limit' => '',
      // 'offset' => '',
      // 'exclusive' => '',
      // 'finderQuery' => '',
      // 'counterQuery' => ''
    ),
    'UserLinkLike' => array(
      'className' => 'UserLinkLike',
      'foreignKey' => 'user_id',
      'dependent' => false,
      // 'conditions' => '',
      // 'fields' => '',
      'order' => 'UserLinkLike.created_at DESC',
      // 'limit' => '',
      // 'offset' => '',
      // 'exclusive' => '',
      // 'finderQuery' => '',
      // 'counterQuery' => ''
    ),
    'UserLinkView' => array(
      'className' => 'UserLinkView',
      'foreignKey' => 'user_id',
      'dependent' => false,
      // 'conditions' => '',
      // 'fields' => '',
      'order' => 'UserLinkView.created_at DESC',
      // 'limit' => '',
      // 'offset' => '',
      // 'exclusive' => '',
      // 'finderQuery' => '',
      // 'counterQuery' => ''
    ),
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
      'unique' => true,
      // 'conditions' => '',
      // 'fields' => '',
      // 'order' => '',
      // 'limit' => '',
      // 'offset' => '',
      // 'finderQuery' => '',
      // 'deleteQuery' => '',
      // 'insertQuery' => ''
    ),
    'followedFriends' => array(
      'className' => 'User',
      'joinTable' => 'friendships',
      'foreignKey' => 'friend_id',
      'associationForeignKey' => 'user_id',
      'unique' => true,
      // 'conditions' => '',
      // 'fields' => '',
      // 'order' => '',
      // 'limit' => '',
      // 'offset' => '',
      // 'finderQuery' => '',
      // 'deleteQuery' => '',
      // 'insertQuery' => ''
    )
  );

}
