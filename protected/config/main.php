<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Инвентаризация компьютеров',
    'sourceLanguage' => 'en',
    'language' => 'ru',
    // preloading 'log' component
//    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.modules.user.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.modules.rights.*',
        'application.modules.rights.models.*',
        'application.modules.rights.components.*',
    ),
    'modules' => array(
        'user' => array(
            'tableUsers' => 'tbl_users',
            'tableProfiles' => 'tbl_profiles',
            'tableProfileFields' => 'tbl_profiles_fields',
            'sendActivationMail' => false,
            'captcha' => array('registration' => false),
            'returnUrl' => array("/computers"),
        ),
        'rights' => array(
            'install' => false,
        ),
    ),
    // application components
    'components' => array(
        'user' => array(
            'class' => 'RWebUser',
            'allowAutoLogin' => true,
            'loginUrl' => array('user/login'),
        ),
        'authManager' => array(
            'class' => 'RDbAuthManager',
            'defaultRoles' => array('Guest'),
            'itemTable' => 'AuthItem',
            'itemChildTable' => 'AuthItemChild',
            'assignmentTable' => 'Authassignment',
            'rightsTable' => 'Rights',
        ),
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=inventar',
            'emulatePrepare' => true,
            'username' => 'inventar',
            'password' => 'mysql',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
//		 'log'=>array(
//			 'class'=>'CLogRouter',
//			 'routes'=>array(
//				 array(
//					 'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
//					 'ipFilters'=>array('10.178.4.15'),
//				 ),
//			 ),
//		 ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'asu0@vitebsk.energo.net',
        'ip_access' => array('10.178.4.15', '10.178.4.3', '10.178.4.14', '10.178.4.30', '10.178.4.31', '10.178.4.17',),
    ),
);