<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
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
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class AppHelper extends Helper {

  public function search($array, $kvs, $depth) {
    $results = array();

    if (is_array($array)) {
      if (is_array($kvs)) {
        $length = count($kvs);
        $count = 0;
        foreach ($kvs as $k => $v) {
          if (isset($array[$k]) && $array[$k] == $v)
            $count += 1;
        }
        if ($count == $length)
          $results[] = $array;
      }

      if ($depth > 0) {
        foreach ($array as $subarray)
          $results = array_merge($results, $this->search($subarray, $kvs, $depth -1));
      }
    }

    return $results;
  }

  public function getDomainFromUrl($url) {
    preg_match("/^(http:\/\/)?([^\/]+)/i",$url, $matches);
    $host = $matches[2];
    preg_match("/[^\.\/]+\.[^\.\/]+$/", $host, $matches);
    return $matches[0];
  }

}
