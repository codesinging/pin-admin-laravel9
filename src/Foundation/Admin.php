<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Foundation;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string version()
 */
class Admin extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Application::LABEL;
    }
}
