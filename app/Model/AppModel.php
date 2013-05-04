<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');
App::uses('CakeEmail', 'Network/Email');
App::uses('FB', 'Facebook.Lib');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

  function save($data = null, $validate = true, $fieldList = array()) {
    $now = date('Y-m-d H:i:s');
    // set created_at field before creation
    // if ((!isset($this->data[$this->name]) || isset($this->data[$this->name]['id'])) && !$this->data[$this->name]['id']) {
		if (!isset($this->data[$this->name]) || !isset($this->data[$this->name]['id'])) {
      $data[$this->name]['created_at'] = $now;
    }
    // set updated_at field value before each save
    $data[$this->name]['updated_at'] = $now;
    return parent::save($data, $validate, $fieldList);
  }
}
