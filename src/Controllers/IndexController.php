<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Controllers;

use CodeSinging\PinAdmin\Foundation\Admin;
use CodeSinging\PinAdmin\Support\Routing\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return Admin::name();
    }
}
