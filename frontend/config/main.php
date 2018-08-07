<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
     'name' => 'ECM2',
      'language' => 'es',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        
        'user' => [
            'identityClass' => 'common\models\User',
            //'identityClass' => 'mdm\admin\models\User',
            'loginUrl' => ['site/login'],
            'enableAutoLogin' => false,
            'authTimeout' => 3600, // auth expire 
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],'session' => [
        'class' => 'yii\web\Session',
        'cookieParams' => ['httponly' => true, 'lifetime' => 3600 * 4],
        'timeout' => 3600*4, //session expire
        'useCookies' => true,
    ],
        
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        
        'urlManagerF' => [
        'class' => 'yii\web\urlManager',
        'baseUrl'=>'http://yii2-starter.dev/',
        'enablePrettyUrl' => true,
        'showScriptName' => false,

        ],
        
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
    ],
    'params' => $params,
    
    
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            'admin/*',
        ]
    ]
    
];
