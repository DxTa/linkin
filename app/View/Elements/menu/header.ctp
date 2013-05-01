<div class="header-content">
  <h1 class="logo">
    <a href='/'> Linkin</a>
</h1>
<ul class="menu-bar">
  <li> <a href='#'> New Links</a></li>
  <li class='line'>|</li>
  <li> <a href='#'> Friends </a></li>

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
      <a href='#'>
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
              <li><a href='#'>Account Settings</a></li>
              <li>
                <?php if ($current_user) {
                  echo $this->Facebook->logout(array('label' => 'Logout', 'redirect' => array('controller' => 'users', 'action' => 'logout')));
                }
                ?>
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
                    <?php for($i=0;$i<10;$i++) { ?>
                    <li>
                      <div class='list-thumb'>
                        <a href='#'><img src='http://linkhay2.vcmedia.vn/thumbs/channels/channel_18_37_logo.jpg'></a>
                      </div>
                      <div class='list-title'>
                        <a href='#'>Culture</a>
                        (10000)
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
  $(".popup").show();
  var test = <?php echo json_encode($this->element('popup/new_link')); ?>;
  $(".popup .popup-content").html(test);
};

var showLogin = function() {
  $(".popup").show();
  var test = <?php echo json_encode($this->element('popup/login')); ?>;
  $(".popup .popup-content").html(test);
};

var showRegister = function() {
  $(".popup").show();
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
      $("#content").unbind()
    }
  })
};




</script>


