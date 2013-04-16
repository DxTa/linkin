<?php
App::uses('UsersController', 'Controller');

/**
 * UsersController Test Case
 *
 */
class UsersControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user',
		'app.image',
		'app.authentication',
		'app.comment',
		'app.like',
		'app.link',
		'app.owner',
		'app.view',
		'app.friendship'
	);

}
