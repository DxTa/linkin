<?php
App::uses('Link', 'Model');

/**
 * Link Test Case
 *
 */
class LinkTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.link',
		'app.owner',
		'app.image',
		'app.like',
		'app.user',
		'app.authentication',
		'app.comment',
		'app.view',
		'app.friendship'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Link = ClassRegistry::init('Link');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Link);

		parent::tearDown();
	}

}
