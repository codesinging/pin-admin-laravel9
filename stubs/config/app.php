<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

return [
    /*
    |--------------------------------------------------------------------------
    | PinAdmin 应用名称
    |--------------------------------------------------------------------------
    |
    | 此名字是 PinAdmin 应用的中文名称，用于显示页面上的标题等地方。
    |
    */
    'name' => env('__DUMMY_UPPER_LABEL_____DUMMY_UPPER_NAME___NAME', '__DUMMY_STUDLY_NAME__'),

    /*
    |--------------------------------------------------------------------------
    | PinAdmin 应用路由前缀
    |--------------------------------------------------------------------------
    |
    | 所有此应用的路由都以此为前缀
    |
    */
    'route_prefix' => env('__DUMMY_UPPER_LABEL_____DUMMY_UPPER_NAME___ROUTE_PREFIX', '__DUMMY_NAME__'),

    /*
    |--------------------------------------------------------------------------
    | PinAdmin 应用路由中间件
    |--------------------------------------------------------------------------
    |
    | 其中应用路由目录下 auth 和 guest 路由文件中的路由会自动注册对应的中间件
    |
    */
    'middlewares' => [
        'guest' => [
            'web',
            'admin.guest:__DUMMY_NAME__',
        ],
        'auth' => [
            'web',
            'admin.auth:__DUMMY_NAME__,__DUMMY_GUARD__',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | 授权认证守卫
    |--------------------------------------------------------------------------
    |
    | 此配置会合并到系统的 auth 配置的 guards 中。
    |
    */
    'auth_guard' => [
        'driver' => 'session',
        'provider' => '__DUMMY_GUARD___users',
    ],

    /*
    |--------------------------------------------------------------------------
    | 授权认证用户提供者
    |--------------------------------------------------------------------------
    |
    | 此配置会合并到系统的 auth 配置的 providers 中。
    |
    */
    'auth_provider' => [
        'driver' => 'eloquent',
        'model' => __DUMMY_NAMESPACE__\Models\__DUMMY_STUDLY_NAME__User::class,
    ],

];
