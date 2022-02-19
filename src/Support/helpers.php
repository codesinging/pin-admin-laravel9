<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

use CodeSinging\PinAdmin\Foundation\Application;
use CodeSinging\PinAdmin\Support\Routing\Response;
use Illuminate\Config\Repository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

if (!function_exists('admin')) {
    /**
     * 返回 PinAdmin 应用实例
     *
     * @param string|null $name
     *
     * @return Application
     */
    function admin(string $name = null): Application
    {
        /** @var Application $app */
        $app = app(Application::LABEL);
        is_null($name) or $app->boot($name);
        return $app;
    }
}

if (!function_exists('admin_config')) {
    /**
     * 获取或设置应用配置值，或者返回应用仓库实例
     *
     * @param array|string|null $key
     * @param mixed|null $default
     *
     * @return Application|Repository|mixed
     */
    function admin_config(array|string $key = null, mixed $default = null)
    {
        return admin()->config($key, $default);
    }
}

if (!function_exists('admin_asset')) {
    /**
     * 返回 PinAdmin 应用静态文件路径
     *
     * @param string $path
     *
     * @return string
     */
    function admin_asset(string $path = ''): string
    {
        return admin()->asset($path);
    }
}

if (!function_exists('admin_mix')) {
    /**
     * 返回带版本号的静态资源文件路径
     *
     * @param string $path
     *
     * @return string
     * @throws Exception
     */
    function admin_mix(string $path): string
    {
        return admin()->mix($path);
    }
}

if (!function_exists('admin_template')) {
    /**
     * 返回位于 PinAdmin 应用目录的模板名
     *
     * @param string $path
     *
     * @return string
     */
    function admin_template(string $path): string
    {
        return admin()->template($path);
    }
}

if (!function_exists('admin_view')) {
    /**
     * 返回位于 PinAdmin 应用目录的视图内容
     *
     * @param string|null $view
     * @param array $data
     * @param array $mergeData
     *
     * @return View|Factory
     */
    function admin_view(string $view = null, array $data = [], array $mergeData = []): View|Factory
    {
        return admin()->view($view, $data, $mergeData);
    }
}

if (!function_exists('admin_page')) {
    /**
     * 返回位于 PinAdmin 应用目录内的单文件组件内容
     *
     * @param string $path
     *
     * @return View|Factory
     */
    function admin_page(string $path): View|Factory
    {
        return admin()->page($path);
    }
}

if (!function_exists('success')) {
    /**
     * 返回正确的 json 响应信息
     *
     * @param $message
     * @param $data
     *
     * @return JsonResponse
     */
    function success($message = null, $data = null): JsonResponse
    {
        return Response::success($message, $data);
    }
}

if (!function_exists('error')) {
    /**
     * 返回错误的 json 响应信息
     *
     * @param $message
     * @param int $code
     * @param $data
     *
     * @return JsonResponse
     */
    function error($message = null, int $code = -1, $data = null): JsonResponse
    {
        return Response::error($message, $code, $data);
    }
}
