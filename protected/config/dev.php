<?php
return CMap::mergeArray(   
    require(dirname(__FILE__).'/main.php'),
    array(
        'modules'=>array(
            'gii'=>array(
                'class'=>'system.gii.GiiModule',
                'password'=>'admin',
             ),
             'yiiadmin'=>array(
                'password'=>'123',
                'registerModels'=>array(
                    'application.models.Computers',
                    //'application.models.BlogPosts',
                    //'application.models.*',
                ),
                //'excludeModels'=>array(),
            ),

        ),
		'components'=>array(
            'log'=>array(
                'class'=>'CLogRouter',
                'routes'=>array(
                    array(
                        'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',                        
                    ),
                ),
            ),
        ),
    )
);