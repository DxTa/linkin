<?php
class AppSchema extends CakeSchema {

	public function before($event = array()) {
    $db = ConnectionManager::getDataSource($this->connection);
    $db->cacheSources = false;
		return true;
	}

  public function after($event = array()) {
    if (isset($event['create'])) {
      switch ($event['create']) {
      case 'users':
        $db = ConnectionManager::getDataSource('default');
        $result = $db->query('ALTER TABLE `users` ADD `facebook_id` BIGINT(20) UNSIGNED NOT NULL DEFAULT 0');
        break;
      case 'categories':
        $db = ConnectionManager::getDataSource('default');
        $c_names = array("The World","Sport","Weather","Bussiness","Technology", "Science", "Entertainment & Art", "Learning", "Health", "gag");
        App::uses('ClassRegistry', 'Utility');
        $category = ClassRegistry::init('Category');
        foreach ($c_names as $v) {
          $category->create();
          $category->save(
            array('Category' => array('name' => $v))
          );
        }
        break;
      }
    }
  }

  public $users = array(
    'id' => array('type' => 'integer', 'null' => false, 'auto_increment' => true, 'key' => 'primary'),
    'email' => array('type' => 'text', 'null' => true, 'default' => null),
    'username' => array('type' => 'text', 'null' => true, 'default' => null),
    'sex' => array('type' => 'text', 'null' => true, 'default' => null),
    'avatar' => array('type' => 'text', 'null' => true, 'default' => null),
    'dob' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    'password' => array('type' => 'text', 'null' => true, 'default' => null),
    'remember_token' => array('type' => 'text', 'null' => true, 'default' => null),
    'active' => array('type' => 'boolean', 'length' => 1, 'null' => false, 'default' => 0),
    'admin' => array('type' => 'boolean', 'length' => 1, 'null' => false, 'default' => 0),
    'created_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
  );

  public $authentications = array(
    'id' => array('type' => 'integer', 'null' => false, 'auto_increment' => true, 'key' => 'primary'),
    'user_id' => array('type' => 'integer', 'null' => false),
    'provider' => array('type' => 'text', 'null' => true, 'default' => null),
    'uid' => array('type' => 'text', 'null' => true, 'default' => null),
    'access_token' => array('type' => 'text', 'null' => true, 'default' => NULL),
    'secret' => array('type' => 'text', 'null' => true, 'default' => null),
    'created_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
  );

  public $friendships = array(
    'id' => array('type' => 'integer', 'null' => false, 'auto_increment' => true, 'key' => 'primary'),
    'user_id' => array('type' => 'integer', 'null' => false),
    'friend_id' => array('type' => 'integer', 'null' => false),
    'state' => array('type' => 'text', 'null' => false),
    'created_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
  );

  public $friendship_states = array(
    'id' => array('type' => 'integer', 'null' => false, 'auto_increment' => true, 'key' => 'primary'),
    'friendship_id' => array('type' => 'integer', 'null' => false),
    'state' => array('type' => 'text', 'null' => false),
    'created_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
  );

  public $links = array(
    'id' => array('type' => 'integer', 'null' => false, 'auto_increment' => true, 'key' => 'primary'),
    'owner_id' => array('type' => 'integer', 'null' => false),
    'category_id' => array('type' => 'integer', 'null' => false),
    'url' => array('type' => 'text', 'null' => true),
    'description' => array('type' => 'text', 'null' => true),
    'message' => array('type' => 'text', 'null' => true),
    'image' => array('type' => 'text', 'null' => true),
    'cnt_comments' => array('type' => 'integer', 'null' => true,'default' => 0),
    'cnt_likes' => array('type' => 'integer', 'null' => true,'default' => 0),
    'cnt_views' => array('type' => 'integer', 'null' => true,'default' => 0),
    'created_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
  );

  public $categories = array(
    'id' => array('type' => 'integer', 'null' => false, 'auto_increment' => true, 'key' => 'primary'),
    'name' => array('type' => 'text', 'null' => true),
    'created_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
  );

  public $images = array(
    'id' => array('type' => 'integer', 'null' => false, 'auto_increment' => true, 'key' => 'primary'),
    'height' => array('type' => 'integer', 'null' => true),
    'width' => array('type' => 'integer', 'null' => true),
    'url' => array('type' => 'text', 'null' => true),
    'path' => array('type' => 'text', 'null' => true),
    'created_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
  );

  public $comments = array(
    'id' => array('type' => 'integer', 'null' => false, 'auto_increment' => true, 'key' => 'primary'),
    'user_id' => array('type' => 'integer', 'null' => false),
    'link_id' => array('type' => 'integer', 'null' => false),
    'content' => array('type' => 'text', 'null' => true),
    'created_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
  );

  public $recomments = array(
    'id' => array('type' => 'integer', 'null' => false, 'auto_increment' => true, 'key' => 'primary'),
    'user_id' => array('type' => 'integer', 'null' => false),
    'comment_id' => array('type' => 'integer', 'null' => false),
    'content' => array('type' => 'text', 'null' => true),
    'created_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
  );

  public $user_link_likes = array(
    'id' => array('type' => 'integer', 'null' => false, 'auto_increment' => true, 'key' => 'primary'),
    'user_id' => array('type' => 'integer', 'null' => false),
    'link_id' => array('type' => 'integer', 'null' => false),
    'created_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1),
    'USER_LINK_LIKE_KEY' => array('column' => array('user_id','link_id'), 'unique' => 1)
  )
);

  public $user_link_views = array(
    'id' => array('type' => 'integer', 'null' => false, 'auto_increment' => true, 'key' => 'primary'),
    'user_id' => array('type' => 'integer', 'null' => false),
    'link_id' => array('type' => 'integer', 'null' => false),
    'created_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1),
    'USER_LINK_VIEW_KEY' => array('column' => array('user_id','link_id'), 'unique' => 1)
  )
);

}
