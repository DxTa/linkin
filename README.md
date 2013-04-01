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
  > mkdir -p app/tmp/{cache,logs,sessions,tests} && mkdir -p app/tmp/cache/{models,persistent,views}<br/>

  ensure app/tmp is writable

* configure you app/Config/database.php (user,password) - (example from app/Config/database.php.default)

Note
====
chỉ push lên branch sub<br/>
trong quá trình cài đặt mà gặp lỗi gì thì google sửa nhé, hoặc liên hệ với giang hồ.

Coding
======

* Update new database
	> after pull new request, run instuction "./app/Console/cake schema create"<br/>
	> if no new table added, can skip above instruction and run: "./app/Console/cake schema update"<br/>

* Model
  > all model is already created, if anyone want to add new, do copycat or google :D<br/>

* Controller
	> same as Model<br/>

* View
	> create view by your own (using google :D, or using bake - google for it =)) )<br/>

* Routes
	> add route by add new line in "./app/Config/routes.php".<br/>
	> There are also some examples in this file.<br/>

* DebugKit
	> DebugKit is debug tool of CakePHP. It is installed. Google how to use it.<br/>
	> very usefull<br/>
