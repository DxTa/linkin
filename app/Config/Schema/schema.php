<?php
class AppSchema extends CakeSchema {

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

  public $users = array(
		'id' => array('type' => 'integer', 'null' => false, 'auto_increment' => true, 'key' => 'primary'),
		'email' => array('type' => 'text', 'null' => false, 'default' => null),
		'username' => array('type' => 'text', 'null' => false, 'default' => null),
		'sex' => array('type' => 'text', 'null' => true, 'default' => null),
    'dob' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    'password' => array('type' => 'text', 'null' => false, 'default' => null),
    'avatar' => array('type' => 'integer', 'null' => false),
    'remember_token' => array('type' => 'text', 'null' => false, 'default' => null),
    'active' => array('type' => 'boolean', 'length' => 1, 'null' => false, 'default' => 0),
    'admin' => array('type' => 'boolean', 'length' => 1, 'null' => false, 'default' => 0),
    'created_at' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
    'updated_at' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);

  public $authentications = array(
		'id' => array('type' => 'integer', 'null' => false, 'auto_increment' => true, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'provider' => array('type' => 'text', 'null' => false, 'default' => null),
		'uid' => array('type' => 'text', 'null' => false, 'default' => null),
    'access_token' => array('type' => 'text', 'null' => false, 'default' => NULL),
    'secret' => array('type' => 'text', 'null' => false, 'default' => null),
    'created_at' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
    'updated_at' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);

  public $friendships = array(
    'id' => array('type' => 'integer', 'null' => false, 'auto_increment' => true, 'key' => 'primary'),
    'user_id' => array('type' => 'integer', 'null' => false),
    'friend_id' => array('type' => 'integer', 'null' => false),
    'state' => array('type' => 'text', 'null' => false),
    'created_at' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
    'updated_at' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
  );

  public $links = array(
    'id' => array('type' => 'integer', 'null' => false, 'auto_increment' => true, 'key' => 'primary'),
    'owner_id' => array('type' => 'integer', 'null' => false),
    'image_id' => array('type' => 'integer', 'null' => false),
    'title' => array('type' => 'text', 'null' => true),
    'description' => array('type' => 'text', 'null' => false),
    'cnt_likes' => array('type' => 'integer', 'null' => true),
    'cnt_views' => array('type' => 'integer', 'null' => true),
    'created_at' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
    'updated_at' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
  );

  public $images = array(
    'id' => array('type' => 'integer', 'null' => false, 'auto_increment' => true, 'key' => 'primary'),
    'height' => array('type' => 'integer', 'null' => false),
    'width' => array('type' => 'integer', 'null' => false),
    'url' => array('type' => 'text', 'null' => false),
    'created_at' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
    'updated_at' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
    'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
  );

  public $comments = array(
    'id' => array('type' => 'integer', 'null' => false, 'auto_increment' => true, 'key' => 'primary'),
    'user_id' => array('type' => 'integer', 'null' => false),
    'title' => array('type' => 'text', 'null' => false),
    'description' => array('type' => 'text', 'null' => false),
    'created_at' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
    'updated_at' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
  );

  public $likes = array(
    'id' => array('type' => 'integer', 'null' => false, 'auto_increment' => true, 'key' => 'primary'),
    'user_id' => array('type' => 'integer', 'null' => false),
    'link_id' => array('type' => 'integer', 'null' => false),
    'created_at' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
    'updated_at' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
    'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1),
                       'USER_LINK_LIKE_KEY' => array('column' => array('user_id','link_id'), 'unique' => 1)
                      )
  );

  public $views = array(
    'id' => array('type' => 'integer', 'null' => false, 'auto_increment' => true, 'key' => 'primary'),
    'user_id' => array('type' => 'integer', 'null' => false),
    'link_id' => array('type' => 'integer', 'null' => false),
    'created_at' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
    'updated_at' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
    'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1),
                      'USER_LINK_VIEW_KEY' => array('column' => array('user_id','link_id'), 'unique' => 1)
                      )
  );

}
