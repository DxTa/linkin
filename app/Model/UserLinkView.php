<?php
App::uses('AppModel', 'Model');
/**
 * View Model
 *
 * @property User $User
 * @property Link $Link
 */
class UserLinkView extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */

  public $recursive = -1;

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
