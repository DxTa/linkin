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
      <?php }else ?>
        <a href='#' class='menu-linkin'>LinkIn</a>
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
      <a href='#' onclick='login()'>Login</a>
      OR
      <a href='#' onlick='register()'>Register</a>
    </li>
  </ul>
</div>

<?php if ($current_user) {
  echo $this->Facebook->logout(array('label' => 'Logout', 'redirect' => array('controller' => 'users', 'action' => 'logout')));
}
?>
</div>
<script type="text/javascript">
var newLink = function() {
  $(".popup").show();
  var test = <?php echo json_encode($this->element('popup/new_link')); ?>;
  $(".popup .popup-content").html(test);
};

var login = function() {
  $(".popup").show();
  var test = <?php echo json_encode($this->element('popup/login')); ?>;
  $(".popup .popup-content").html(test);
}

</script>


