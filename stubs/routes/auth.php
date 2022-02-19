<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

use Illuminate\Support\Facades\Route;
use __DUMMY_NAMESPACE__\Controllers;

// 本文件中的路由需要认证才能访问

Route::get('/', [Controllers\IndexController::class, 'index']);
