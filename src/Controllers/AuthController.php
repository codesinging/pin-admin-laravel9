<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Controllers;

use CodeSinging\PinAdmin\Foundation\Admin;
use CodeSinging\PinAdmin\Support\Routing\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(): View|Factory
    {
        return admin_page('auth.index');
    }

    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required']
        ]);

        if (Admin::auth()->attempt($credentials)) {
            if (!Admin::user()['status']) {
                return $this->error('用户状态异常');
            }

            return $this->success('登录成功');
        }

        return $this->error('账号和密码不匹配');
    }
}
