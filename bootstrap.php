<?php
require_once 'config/defs.php';

set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__FILE__) . '/lib/');
require_once 'Zend/Loader/Autoloader.php';
$autoloader = Zend_Loader_Autoloader::getInstance();
$autoloader->registerNamespace('OS_');

