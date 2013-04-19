<?php
App::uses('AppModel', 'Model');

class Recomment extends AppModel {

	public $validate = array(
		'content' => array(
			'minlength' => array(
				'rule' => array('minlength',2),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			// 'conditions' => '',
			// 'fields' => '',
			// 'order' => ''
    ),
    'Comment' => array(
      'className' => 'Comment',
      'foreginKey' => 'comment_id'
    )
	);
}
