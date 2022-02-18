<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

use CodeSinging\PinAdmin\Foundation\Admin;
use Illuminate\Support\Facades\Route;

// 本文件中的路由无需认证就能访问

Route::get('auth', function () {
    return Admin::name();
});
