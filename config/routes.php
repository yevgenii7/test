<?php

return [
    '/' => 'site/index',
    'site/login' => 'site/login',
    'site/logout' => 'site/logout',
    //user routs
    'user' => 'user/index',
    'user/create' => 'user/create',
    'user/<action:(view|update|delete)>/<id:\d*>' => 'user/<action>',
    //product routs
    'product' => 'product/index',
    'product/create' => 'product/create',
    'product/<action:(view|update|delete)>/<id:\d*>' => 'product/<action>',
    //order routs
    'order' => 'order/index',
    'order/create' => 'order/create',
    'order/<action:(view|update|delete)>/<id:\d*>' => 'order/<action>',
    // дополнительно
    'admin/test/<id:\d+>/edit' => 'test/edit',
    'admin' => 'admin/index',
    
    // RESTful маршруты
    [
        'class' => 'yii\rest\UrlRule', 
        'controller' => 'api/order',
        /*,'except' => ['delete']*/
        'extraPatterns' => [
            'GET test' => 'test',
        ],
    ],
    ];