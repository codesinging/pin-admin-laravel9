<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Middleware;

use Closure;
use CodeSinging\PinAdmin\Foundation\Admin;
use Illuminate\Http\Request;

class Guest
{
    public function handle(Request $request, Closure $next, string $name)
    {
        Admin::boot($name);

        return $next($request);
    }
}
