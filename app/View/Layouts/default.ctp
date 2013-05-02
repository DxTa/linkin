<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

?>
<!DOCTYPE html>
<?php $title_for_layout = 'Linkin' ?>

<?php echo $this->Facebook->html(); ?>
<head>
  <?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
    echo $this->Html->meta('icon');

    // echo $this->Html->css('layout');
    echo $this->Html->css('bootstrap.min');
    echo $this->Html->css('bootstrap-responsive.min');
    echo $this->Html->css('link');
    echo $this->Html->css('custom');
    echo $this->Html->css('popup');
    // echo $this->Html->css('core');
    echo $this->Html->script('jquery');
    echo $this->Html->script('bootstrap.min');

		echo $this->fetch('meta');
		echo $this->fetch('css');
    echo $this->fetch('script');
    echo $this->Facebook->init();
	?>
</head>
<body>
	<div id="container">
		<div id="header">
      <?php echo $this->element('menu/header'); ?>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
      <?php echo $this->element('menu/footer'); ?>
		</div>
	</div>
  <?php echo $this->element('popup/popup') ?>
</body>
</html>

<script type="text/javascript">
var hidePopup = function() {
  $(".popup").hide();
  $('body').css('overflow','');
}
var showPopup = function() {
  $(".popup").show();
  $('body').css('overflow','hidden');
}
</script>
