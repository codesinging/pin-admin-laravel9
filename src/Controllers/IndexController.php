<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Controllers;

use CodeSinging\PinAdmin\Support\Routing\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class IndexController extends Controller
{
    public function index(): Factory|View
    {
        return admin_page('index.index');
    }
}
