<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Foundation;

use Closure;
use Illuminate\Config\Repository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string version()
 * @method static string brand()
 * @method static string label(string $suffix = null, string $separator = '_')
 * @method static string rootDirectory(?string ...$paths)
 * @method static string rootPath(?string ...$paths)
 * @method static string rootAppDirectory(?string ...$paths)
 * @method static string rootAppPath(?string ...$paths)
 * @method static string rootPublicDirectory(?string ...$paths)
 * @method static string rootPublicPath(?string ...$paths)
 * @method static string packagePath(?string ...$paths)
 * @method static string name(string $suffix = null, string $separator = '_')
 * @method static string studlyName(string $suffix = '')
 * @method static string guard()
 * @method static string directory(?string ...$paths)
 * @method static string path(?string ...$paths)
 * @method static string appDirectory(?string ...$paths)
 * @method static string appPath(?string ...$paths)
 * @method static string publicDirectory(?string ...$paths)
 * @method static string publicPath(?string ...$paths)
 * @method static string getNamespace(?string ...$paths)
 * @method static array indexes()
 * @method static Application boot(string $name)
 * @method static Application|Repository|mixed config(array|string $key = null, mixed $default = null)
 * @method static string routePrefix()
 * @method static string link(string $path = '', array $parameters = [])
 * @method static string asset(?string ...$paths)
 * @method static string mix(string $path)
 * @method static string homeUrl(bool $withDomain = false)
 * @method static string template(string $path)
 * @method static Factory|View view(string $view = null, array $data = [], array $mergeData = [])
 * @method static Factory|View page(string $path)
 */
class Admin extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Application::LABEL;
    }
}
