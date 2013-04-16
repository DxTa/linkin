<?php
App::uses('AppModel', 'Model');
/**
 * Friendship Model
 *
 * @property User $User
 * @property User $Friend
 */
class Friendship extends AppModel {

  public $actsAs = array('StateMachine');


  public $states = array(
    'pending' => array(
      'approve' => 'approved',
      'destroy' => 'destroyed'
    ),
    'approved' => array(
      'destroy' => 'destroyed'
    )
  );

  // validate
  //

  public $validate = array
    (
      'user_id' => array
      (
        'uniqueFields' => array(
          'rule' => array('checkUnique', array('user_id', 'friend_id')),
          'message' => 'Your friendships already existed.',
        ),
        'notIdentical' => array
        (
          'rule' => array('notIdenticalFieldValues', 'friend_id'),
          'message' => 'can not add yourself.'
        )
      )
    );

  public function checkUnique($data, $fields) {
    if (!is_array($fields)) {
      $fields = array($fields);
    }
    foreach($fields as $key) {
      $tmp[$key] = $this->data[$this->name][$key];
    }
    $fields_inverse_iterator = end($fields);
    foreach($fields as $key) {
      $tmp2[$key] = $this->data[$this->name][$fields_inverse_iterator];
      $fields_inverse_iterator=prev($fields);
    }
    if (isset($this->data[$this->name][$this->primaryKey])) {
      $tmp[$this->primaryKey] = "<>".$this->data[$this->name][$this->primaryKey];

    }
    return ($this->isUnique($tmp, false) && $this->isUnique($tmp2,false));
  }

  public function notIdenticalFieldValues( $field=array(), $compare_field=null ) {
    foreach( $field as $key => $value ){
      $v1 = $value;
      $v2 = $this->data[$this->name][ $compare_field ];
      if($v1 !== $v2) {
        return TRUE;
      } else {
        continue;
      }
    }
    return FALSE;
  }


  //The Associations below have been created with all possible keys, those that are not needed can be removed

  /**
   * belongsTo associations
   *
   * @var array
   */
  public $belongsTo = array(
    'User' => array(
      'className' => 'User',
      'foreignKey' => 'user_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
    ),
    'Friend' => array(
      'className' => 'User',
      'foreignKey' => 'friend_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
    )
  );
}
