Linkin header

<?php if ($current_user) {
  echo $this->Facebook->logout(array('label' => 'Logout', 'redirect' => array('controller' => 'users', 'action' => 'logout')));
  //echo $this->Facebook->share(); //default is current address
}
?>


