<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

use CodeSinging\PinAdmin\Foundation\Admin;
use Illuminate\Support\Facades\Route;

Admin::boot('__DUMMY_NAME__')
    ->guestRoutes(function (){
        Route::get('/', function (){
            return Admin::name();
        });
    })
    ->authRoutes(function (){

    });
