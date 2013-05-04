<div class="header-content">
  <h1 class="logo">
    <a href='/'> Linkin</a>
</h1>
<ul class="menu-bar">
  <li> <a href='/links/news'> New Links</a></li>
  <li class='line'>|</li>
  <?php if (isset($current_user['User']['id'])): ?>
    <li> <a href='/users/view_friends/<?php echo $current_user['User']['id']?>'> Friends </a></li>
  <?php else:?>
    <li> <a href='#'> Friends </a></li>
  <?php endif ?>

  <li class='menu-btn'>
    <div>
      <?php if($current_user)  {?>
        <a href='#' class='menu-linkin' onclick='newLink()'>LinkIn</a>
      <?php }else  {?>
        <a href='#' class='menu-linkin'>LinkIn</a>
      <?php }  ?>
    </div>
  </li>
  <li class='menu-btn'>
    <div>
      <a href='#' class='menu-photo'>Photo</a>
    </div>
  </li>

</ul>


<div class='header-right'>
  <ul id='profile'>
    <li>
      <?php if(!$current_user)  { ?>
      <a href='#' onclick='showLogin()'>Login</a>
      OR
      <a href='#' onclick='showRegister()'>Register</a>
      <?php } else {?>
      <a href='/users/view/<?php echo $current_user['User']['id'] ?>'>
        <img src="<?php echo $current_user['User']['avatar']?>" class='small-avatar' />
        <?php echo $current_user['User']['username'] ?>
      </a>
      <span class='acc-link' onclick='showDropdown()'>
        <div class='arrow-down menu-dropdown'></div>
      </span>
      <div class='top-channel-box'>
        <div class='top-channel-box-inner'>
          <div class='user-menu-top'>
            <ul>
              <li><a href='/users/edit/<?php echo $current_user['User']['id'] ?>'>Account Settings</a></li>
              <?php if($current_user['User']['admin'] == 1) : ?>
              <li><a href='/users/admin'>Admin Settings</a></li>
              <?php endif ?>
              <li>
                <?php if ($current_user) { ?>
                    <a href='/users/logout'>Logout</a>
                <?php } ?>
              </li>
            </ul>
          </div>
          <div class='user-channel-top'>
            <div class='head-menu'>
              <div class='channel-link'>
                <a href='#'> Channels </a>
              </div>
              <div class="clear"></div>
            </div>
            <div class="top-channel-list">
              <div class='lists-content'>
                <div class='list-list'>
                  <ul rel='2'>
                    <?php foreach($channels as $channel) { ?>
                    <li>
                      <div class='list-thumb'>
                        <a href='/categories/view/<?php echo $channel['Category']['id']?>'><img src='/app/webroot/img/channel/<?php echo $channel['Category']['id'] ?>.jpg'></a>
                      </div>
                      <div class='list-title'>
                        <a href='/categories/view/<?php echo $channel['Category']['id'] ?>'><?php echo $channel['Category']['name'] ?></a>
                        (<?php echo count($channel['links']) ?>)
                      </div>
                    </li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
              <div class='clear'></div>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
    </li>
  </ul>
</div>

</div>
<script type="text/javascript">
var newLink = function() {
  showPopup();
  var test = <?php echo json_encode($this->element('popup/new_link')); ?>;
  $(".popup .popup-content").html(test);
};

var showLogin = function() {
  showPopup();
  var test = <?php echo json_encode($this->element('popup/login')); ?>;
  $(".popup .popup-content").html(test);
};

var showRegister = function() {
  showPopup();
  var test = <?php echo json_encode($this->element('popup/register')); ?>;
  $(".popup .popup-content").html(test);
};

var showDropdown = function() {
  $(".menu-dropdown").addClass('expand');
  $(".top-channel-box").show();
  $("#content").click(function() {
    if($(".top-channel-box").is(":visible")) {
      $(".top-channel-box").hide();
      $(".menu-dropdown").removeClass('expand');
      $("#content").unbind();
    }
  })
};




</script>


