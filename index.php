<?php

$yii=dirname(__FILE__).DIRECTORY_SEPARATOR.'..\yii\yii.php';
if ($_SERVER['REMOTE_ADDR']='10.178.4.15') {
$config=dirname(__FILE__).'/protected/config/dev.php';
} else {
$config=dirname(__FILE__).'/protected/config/main.php';
}



// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',false);

require_once($yii);
Yii::createWebApplication($config)->run();