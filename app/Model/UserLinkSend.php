<?php
App::uses('AppModel', 'Model');
/**
 * Like Model
 *
 * @property User $User
 * @property Link $Link
 */
class UserLinkSend extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */

  public $recursive = 3;

	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			// 'conditions' => '',
			// 'fields' => '',
			// 'order' => ''
		),
		'Link' => array(
			'className' => 'Link',
			'foreignKey' => 'link_id',
			// 'conditions' => '',
			// 'fields' => '',
			// 'order' => ''
		)
	);
}
