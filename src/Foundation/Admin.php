<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Foundation;

use Illuminate\Config\Repository;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string version()
 * @method static string brand()
 * @method static string label(string $suffix = null, string $separator = '_')
 * @method static string rootDirectory(...$paths)
 * @method static string rootPath(...$paths)
 * @method static string packagePath(...$paths)
 * @method static string name(string $suffix = null, string $separator = '_')
 * @method static string studlyName(string $suffix = '')
 * @method static string guard()
 * @method static string directory(string ...$paths)
 * @method static string path(string ...$paths)
 * @method static string appDirectory(string ...$paths)
 * @method static string appPath(string ...$paths)
 * @method static string publicDirectory(string ...$paths)
 * @method static string publicPath(string ...$paths)
 * @method static string getNamespace(string ...$paths)
 * @method static Application boot(string $name)
 * @method static Application|Repository|mixed config(array|string $key = null, mixed $default = null)
 */
class Admin extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Application::LABEL;
    }
}
