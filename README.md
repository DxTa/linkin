linkin
======

link suggestion - php - Web Programming Project ICT2 2012-2

Setup
=====

* Requirements
  * php5.4 hay mới hơn, hỗ trợ sẵn web-server nên không cần cài thêm apache<br/>
    more info http://net.tutsplus.com/tutorials/php/php-5-4-is-here-what-you-must-know/
  * mysql (cho nó đơn giản)<br/>

* create database name "ictwp9"

* make folders
  > app/tmp<br/>
  > app/tmp/cache<br/>
  > app/tmp/cache/models<br/>
  > app/tmp/cache/persistent<br/>
  > app/tmp/cache/views<br/>
  > app/tmp/logs<br/>
  > app/tmp/sessions<br/>
  > app/tmp/tests<br/>

  For unix-line command
  > cd #{PROJECT}<br/>
  > mkdir app/tmp/{cache,logs,sessions,tests} && mkdir -p app/tmp/cache/{models,persistent,views}<br/>

  ensure app/tmp is writable

* configure you app/Config/database.php (user,password) - (example from app/Config/database.php.default)

Note
====
chỉ push lên branch master<br/>
trong quá trình cài đặt mà gặp lỗi gì thì google sửa nhé, hoặc liên hệ với giang hồ.

