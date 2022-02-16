<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Foundation;

use Exception;
use Illuminate\Config\Repository;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class Application
{
    /**
     * PinAdmin 版本号
     *
     * @var string
     */
    const VERSION = '1.0.0';

    /**
     * PinAdmin 品牌名称
     */
    const BRAND = 'PinAdmin';

    /**
     * PinAdmin 标记
     */
    const LABEL = 'admin';

    /**
     * PinAdmin 应用根目录
     */
    const ROOT_DIRECTORY = 'admins';

    /**
     * PinAdmin 应用类文件根目录
     */
    const ROOT_APP_DIRECTORY = 'Admins';

    /**
     * PinAdmin 应用公共文件根目录
     */
    const ROOT_PUBLIC_DIRECTORY = 'admins';

    /**
     * PinAdmin 应用名称
     *
     * @var string
     */
    protected string $name;

    /**
     * PinAdmin 应用名称，驼峰形式
     *
     * @var string
     */
    protected string $studlyName;

    /**
     * PinAdmin 应用用户认证守护者
     *
     * @var string
     */
    protected string $guard;

    /**
     * PinAdmin 应用基础目录
     *
     * @var string
     */
    protected string $directory;

    /**
     * PinAdmin 应用类文件目录
     *
     * @var string
     */
    protected string $appDirectory;

    /**
     * PinAdmin 应用公共文件目录
     *
     * @var string
     */
    protected string $publicDirectory;

    /**
     * PinAdmin 应用配置仓库
     *
     * @var Repository
     */
    protected Repository $config;

    /**
     * @param string|null $name
     */
    public function __construct(string $name = null)
    {
        empty($name) or $this->boot($name);
    }

    /**
     * 返回 PinAdmin 版本号
     *
     * @return string
     */
    public function version(): string
    {
        return self::VERSION;
    }

    /**
     * 返回 PinAdmin 的品牌名
     *
     * @return string
     */
    public function brand(): string
    {
        return self::BRAND;
    }

    /**
     * 返回 PinAdmin 标记及以该标记为前缀的字符串
     *
     * @param string|null $suffix
     * @param string $separator
     *
     * @return string
     */
    public function label(string $suffix = null, string $separator = '_'): string
    {
        return self::LABEL . ($suffix ? $separator . $suffix : '');
    }

    /**
     * 返回 PinAdmin 应用根目录或指定子目录
     *
     * @param string|null ...$paths
     *
     * @return string
     */
    public function rootDirectory(?string ...$paths): string
    {
        array_unshift($paths, self::ROOT_DIRECTORY);
        return implode(DIRECTORY_SEPARATOR, $paths);
    }

    /**
     * 返回 PinAdmin 应用根路径或指定子路径
     *
     * @param string|null ...$paths
     *
     * @return string
     */
    public function rootPath(?string ...$paths): string
    {
        return base_path($this->rootDirectory(...$paths));
    }

    /**
     * 返回 PinAdmin 包路径
     *
     * @param string|null ...$paths
     *
     * @return string
     */
    public function packagePath(?string ...$paths): string
    {
        array_unshift($paths, dirname(__DIR__, 2));
        return implode(DIRECTORY_SEPARATOR, $paths);
    }

    /**
     * 返回 PinAdmin 应用名称
     *
     * @param string|null $suffix
     * @param string $separator
     *
     * @return string
     */
    public function name(string $suffix = null, string $separator = '_'): string
    {
        return $this->name . ($suffix ? $separator . $suffix : '');
    }

    /**
     * 返回 PinAdmin 驼峰形式的应用名称
     *
     * @param string $suffix
     *
     * @return string
     */
    public function studlyName(string $suffix = ''): string
    {
        return $this->studlyName . Str::studly($suffix);
    }

    /**
     * 返回 PinAdmin 应用认证守护者
     *
     * @return string
     */
    public function guard(): string
    {
        return $this->guard;
    }

    /**
     * 返回 PinAdmin 应用基础目录或者其指定子目录
     *
     * @param string ...$paths
     *
     * @return string
     */
    public function directory(?string ...$paths): string
    {
        array_unshift($paths, $this->directory);
        return implode('/', $paths);
    }

    /**
     * 返回 PinAdmin 应用基础路径或指定的子路径
     *
     * @param string ...$paths
     *
     * @return string
     */
    public function path(?string ...$paths): string
    {
        return base_path($this->directory(...$paths));
    }

    /**
     * 返回 PinAdmin 应用的应用类文件目录或指定的子目录
     *
     * @param string ...$paths
     *
     * @return string
     */
    public function appDirectory(?string ...$paths): string
    {
        array_unshift($paths, $this->appDirectory);
        return implode('/', $paths);
    }

    /**
     * 返回 PinAdmin 应用的应用类文件路径或指定子路径
     *
     * @param string ...$paths
     *
     * @return string
     */
    public function appPath(?string ...$paths): string
    {
        return app_path($this->appDirectory(...$paths));
    }

    /**
     * 返回 PinAdmin 应用的公共文件目录或指定的子目录
     *
     * @param string ...$paths
     *
     * @return string
     */
    public function publicDirectory(?string ...$paths): string
    {
        array_unshift($paths, $this->publicDirectory);
        return implode('/', $paths);
    }

    /**
     * 返回 PinAdmin 应用的公共文件路径或指定子路径
     *
     * @param string ...$paths
     *
     * @return string
     */
    public function publicPath(?string ...$paths): string
    {
        return public_path($this->publicDirectory(...$paths));
    }

    /**
     * 返回 PinAdmin 应用类命名空间
     *
     * @param string|null ...$paths
     *
     * @return string
     */
    public function getNamespace(?string ...$paths): string
    {
        return implode('\\', ['App', str_replace('/', '\\', $this->appDirectory(...$paths))]);
    }

    /**
     * 初始化应用基础信息
     *
     * @param string $name
     *
     * @return void
     */
    private function initInfo(string $name)
    {
        $this->name = Str::snake($name);
        $this->studlyName = Str::studly($name);
        $this->guard = $name;
        $this->directory = $this->rootDirectory($this->name);
        $this->appDirectory = self::ROOT_APP_DIRECTORY . DIRECTORY_SEPARATOR . $this->studlyName;
        $this->publicDirectory = self::ROOT_PUBLIC_DIRECTORY . DIRECTORY_SEPARATOR . $this->name;
    }

    /**
     * 初始化应用配置
     *
     * @return void
     */
    private function initConfig()
    {
        if (file_exists($file = $this->path('config/app.php'))) {
            $items = require($file);
        }
        $this->config = new Repository($items ?? []);
    }

    /**
     * 启动 PinAdmin 应用
     *
     * @param string $name
     *
     * @return $this
     */
    public function boot(string $name): static
    {
        if (!isset($this->name) || $this->name !== $name) {
            $this->initInfo($name);
            $this->initConfig();
        }

        return $this;
    }

    /**
     * 获取或设置应用配置值，或者返回应用仓库实例
     *
     * @param array|string|null $key
     * @param mixed|null $default
     *
     * @return Application|Repository|mixed
     */
    public function config(array|string $key = null, mixed $default = null)
    {
        if (is_null($key)) {
            return $this->config;
        }
        if (is_array($key)) {
            $this->config->set($key);
            return $this;
        }
        return $this->config->get($key, $default);
    }

    /**
     * 返回 PinAdmin 应用路由前缀
     *
     * @return string
     */
    public function routePrefix(): string
    {
        return $this->config('route_prefix', $this->name());
    }

    /**
     * 获取 PinAdmin 应用的绝对链接地址
     *
     * @param string $path
     * @param array $parameters
     *
     * @return string
     */
    public function link(string $path = '', array $parameters = []): string
    {
        $link = '/' . $this->routePrefix();
        $path and $link .= Str::start($path, '/');
        $parameters and $link .= '?' . http_build_query($parameters);

        return $link;
    }

    /**
     * 返回当前应用的静态文件地址
     *
     * @param string|null ...$paths
     *
     * @return string
     */
    public function asset(?string ...$paths): string
    {
        if (Str::startsWith($path = implode('/', $paths), ['https://', 'http://', '//', '/'])) {
            return $path;
        }

        return '/' . $this->publicDirectory(...$paths);
    }

    /**
     * 返回带版本号的静态资源文件路径
     *
     * @param string $path
     *
     * @return string
     * @throws Exception
     */
    public function mix(string $path): string
    {
        return mix($path, rtrim($this->asset(), '/'));
    }

    /**
     * 返回当前 PinAdmin 应用首页地址
     *
     * @param bool $withDomain
     *
     * @return string
     */
    public function homeUrl(bool $withDomain = false): string
    {
        if ($withDomain) {
            return (Request::secure() ? 'https://' : 'http://') . Request::server('HTTP_HOST') . '/' . $this->routePrefix();
        }
        return '/' . $this->routePrefix();
    }
}
