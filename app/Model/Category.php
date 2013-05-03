<?php
App::uses('AppModel', 'Model');
/**
 * Comment Model
 *
 * @property Category $Category
 */
class Category extends AppModel {

/**
 * Display field
 *
 * @var string
 */

/**
 * Validation rules
 *
 * @var array
 */

  public $recursive = 3;

	public $validate = array(
		'name' => array(
			'minlength' => array(
				'rule' => array('minlength',3),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * associations
 *
 * @var array
 */
	public $hasMany = array(
    'links' => array(
      'className' => 'Link',
			'foreignKey' => 'category_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
    )
  );

}
