<?php
include 'faker.php';
// nead to disable AuthComponent::password in function beforeSave in app/Model/User.php

class AppSchema extends CakeSchema {

	public function before($event = array()) {
    $db = ConnectionManager::getDataSource($this->connection);
    $db->cacheSources = false;
		return true;
	}

  public function after($event = array()) {
   $urls = array(
        'http://kenh14.vn/fashion/angela-phuong-trinh-tuyet-duong-sexy-voi-nhung-bo-bikini-mau-sac-20130503080144663.chn',
        'http://kenh14.vn/star/dan-sao-viet-xinh-nhu-mong-tap-nap-tren-tham-do-htv-awards-20130504071843640.chn',
        'http://kenh14.vn/doi-song/linh-napie-nu-sinh-tung-lam-nguoi-yeu-trong-mv-cua-nhieu-nam-ca-sy-20130425025638423.chn',
        'http://kenh14.vn/star/keira-knightley-to-chuc-dam-cuoi-gian-di-20135423443161.chn',
        'http://kenh14.vn/cine/banh-trang-nha-phuong-muon-lam-nguoi-da-nhan-cach-20130429110010701.chn',
        'http://kenh14.vn/cine/iu-bat-mi-chuyen-bi-lua-dao-20130504020718839.chn',
        'http://giaitri.vnexpress.net/tin-tuc/gioi-sao/trong-nuoc/ngoc-anh-tu-anh-tuoi-tan-di-mua-sam-2743675.html',
        'http://giaitri.vnexpress.net/tin-tuc/gioi-sao/quoc-te/bo-phan-dep-nhat-tren-co-the-sao-goc-hoa-2741775.html',
        'http://giaitri.vnexpress.net/tin-tuc/gioi-sao/quoc-te/20-phu-nu-goi-cam-nhat-the-gioi-2013-2741506.html',
        'http://giaitri.vnexpress.net/tin-tuc/gioi-sao/quoc-te/angelina-jolie-cang-tran-suc-song-nam-16-tuoi-2741254.html'
    );
    $faker = new Faker;
    if (isset($event['create'])) {
      switch ($event['create']) {
      case 'users':
        $db = ConnectionManager::getDataSource('default');
        $result = $db->query('ALTER TABLE `users` ADD `facebook_id` BIGINT(20) UNSIGNED NOT NULL DEFAULT 0');
        App::uses('ClassRegistry', 'Utility');
        $user = ClassRegistry::init('User');
        for ($i=1; $i<=10; $i++) {
          $user->create();
          $user->save(
            array('User' => array(
              'username' => 'user'.$i,
              'email' => 'user'.$i.'@gmail.com',
              'sex' => 'male',
              'password' => '67a56683fbe216ea963cebe001d0e7dcae5b4a51',
              'avatar' => 'http://lorempixel.com/600/600/people',
              // 'avatar' => 'app/webroot/img/default_avatar.png', //for offline
              'active' => 1
              )
            )
          );
        }
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
      case 'links':
        App::uses('ClassRegistry', 'Utility');
        $link = ClassRegistry::init('Link');
        for ($i=1; $i<=5; $i++) {
          for ($j=1;$j<=10;$j++) {
            $link->create();
            $link->save(
              array('Link' => array(
                'owner_id' => $i,
                'category_id' => rand(1,10),
                'description' => implode(' ',$faker->Lorem->sentences(2)),
                'message' => implode(' ',$faker->Lorem->sentences(1)),
                'url' => $urls[rand(0,9)],
                'image' => 'http://lorempixel.com/'.(rand(3,6)*100).'/'.(rand(3,6)*100).'/fashion'
                // 'image' => 'app/webroot/img/channel/10.jpg' //for offline
                )
              )
            );
          }
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

  public $categories = array(
    'id' => array('type' => 'integer', 'null' => false, 'auto_increment' => true, 'key' => 'primary'),
    'name' => array('type' => 'text', 'null' => true),
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
