<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

use CodeSinging\PinAdmin\Foundation\Admin;
use Illuminate\Support\Facades\Route;

// 本文件中的路由需要认证才能访问

Route::get('/', function () {
    return Admin::name();
});
