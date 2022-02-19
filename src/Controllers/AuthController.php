<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Controllers;

use CodeSinging\PinAdmin\Support\Routing\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class AuthController extends Controller
{
    public function index(): View|Factory
    {
        return admin_page('auth.index');
    }
}
